import { gsap } from 'gsap';

export function useNewsletterForm(form: HTMLFormElement) {
    if (!form) return;

    const submitButton = form.querySelector<HTMLButtonElement>('button[type="submit"]');
    const feedbackContainer = document.createElement('div');
    feedbackContainer.className = 'newsletter-feedback';
    form.appendChild(feedbackContainer);

    const loadingDots = document.createElement('div');
    loadingDots.className = 'loading-dots';
    form.appendChild(loadingDots);

    function setLoading(isLoading: boolean): void {
        if (!submitButton) return;

        if (isLoading) {
            gsap.to(submitButton, {
                scale: 1.1,
                backgroundColor: '#0056b3',
                repeat: -1,
                yoyo: true,
                duration: 0.6,
            });

            const dots = Array.from(loadingDots.children);
            gsap.fromTo(
                dots,
                { scale: 0.5, opacity: 0.3 },
                {
                    scale: 1,
                    opacity: 1,
                    stagger: 0.2,
                    repeat: -1,
                    yoyo: true,
                    duration: 0.6,
                },
            );
        } else {
            gsap.killTweensOf(submitButton);
            gsap.to(submitButton, {
                scale: 1,
                backgroundColor: '#007bff',
                duration: 0.3,
            });
            loadingDots.innerHTML = '';
        }
    }

    function showFeedback(message: string, errors: string[] = [], type: 'success' | 'error'): void {
        feedbackContainer.innerHTML = `<p class="${type}">${message}</p>${errors.length > 0 ? `<ul>${errors.map((err) => `<li>${err}</li>`).join('')}</ul>` : ''}`;
        const feedbackMessage = feedbackContainer.querySelector('p')!;
        const feedbackList = feedbackContainer.querySelector('ul');

        gsap.fromTo(feedbackMessage, { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 0.5, ease: 'power3.out' });

        if (feedbackList) {
            gsap.fromTo(
                feedbackList.children,
                { opacity: 0, x: -10 },
                {
                    opacity: 1,
                    x: 0,
                    duration: 0.3,
                    stagger: 0.1,
                    ease: 'power2.out',
                },
            );
        }

        if (type === 'success') {
            setTimeout(() => {
                gsap.to(feedbackContainer, {
                    opacity: 0,
                    y: -20,
                    duration: 0.5,
                    onComplete: () => {
                        feedbackContainer.innerHTML = '';
                    },
                });
            }, 5000);
        }
    }

    async function handleSubmit(event: Event): Promise<void> {
        event.preventDefault();
        setLoading(true);

        try {
            const formData = new FormData(form);
            const response = await submitForm(formData);

            if (response.success) {
                showFeedback(response.message, [], 'success');
                form.reset();
            } else {
                showFeedback(response.message, response.errors || [], 'error');
            }
        } catch (error) {
            showFeedback('Serverfehler. Bitte versuche es später erneut.', [], 'error');
        } finally {
            setLoading(false);
        }
    }

    async function submitForm(data: FormData): Promise<{ success: boolean; message: string; errors?: string[] }> {
        const endpoint = form.action;

        const response = await fetch(endpoint, {
            method: 'POST',
            body: data,
        });

        if (!response.ok) {
            throw new Error('Netzwerkfehler beim Senden des Formulars.');
        }

        return await response.json();
    }

    [...Array(3).keys()].map(() => {
        const dot = document.createElement('span');
        dot.className = 'dot';
        loadingDots.appendChild(dot);
    });

    form.addEventListener('submit', handleSubmit);
}

document.addEventListener('DOMContentLoaded', () => {
    try {
      Array.from(document.querySelectorAll<HTMLFormElement>("[data-component='newsletterForm']")).map(useNewsletterForm)
    } catch (error) {
        console.error('Fehler beim Initialisieren des Formulars:', error);
    }
});
