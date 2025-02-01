import '@fontsource-variable/playfair-display/wght-italic.css';
import '@fontsource-variable/jost';
import { animate, inView } from 'motion';
import * as Sentry from "@sentry/browser";

Sentry.init({
  dsn: "https://ed76bcaaed9f4232864700db3c45f5ac@bug.letsbenow.de/1",

  // Alternatively, use `process.env.npm_package_version` for a dynamic release version
  // if your build tool supports it.
  release: "rolling",
  integrations: [
    Sentry.browserTracingIntegration(),
    Sentry.replayIntegration(),
  ],

  // Set tracesSampleRate to 1.0 to capture 100%
  // of transactions for tracing.
  // We recommend adjusting this value in production
  // Learn more at
  // https://docs.sentry.io/platforms/javascript/configuration/options/#traces-sample-rate
  tracesSampleRate: 1.0,

  // Set `tracePropagationTargets` to control for which URLs trace propagation should be enabled
  tracePropagationTargets: ["localhost", /^https:\/\/mens-circle\.de/],

  // Capture Replay for 10% of all sessions,
  // plus for 100% of sessions with an error
  // Learn more at
  // https://docs.sentry.io/platforms/javascript/session-replay/configuration/#general-integration-configuration
  replaysSessionSampleRate: 0.1,
  replaysOnErrorSampleRate: 1.0,
});

document.addEventListener('DOMContentLoaded', () => {
    inView('[data-animate="fadeUp"]', ({ target }) => {
        if(!target) return;

        const delay = (target as HTMLElement).dataset?.delay ?? 0;
        const duration = (target as HTMLElement).dataset?.duration ?? 0.5;
        animate(
            target,
            { opacity: 1, y: [100, 0] },
            {
                delay: delay as number,
                duration: duration as number,
            },
        );
    });

    inView('[data-animate="fadeDown"]', ({ target }) => {
      if(!target) return;

      const delay = (target as HTMLElement).dataset?.delay ?? 0;
      const duration = (target as HTMLElement).dataset?.duration ?? 0.5;
        animate(
            target,
            { opacity: 1, y: [-100, 0] },
            {
                delay: delay as number,
              duration: duration as number,
            },
        );
    });
});
