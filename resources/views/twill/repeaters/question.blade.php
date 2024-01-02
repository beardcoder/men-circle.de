@twillRepeaterTitle(__('messages.question'))
@twillRepeaterTrigger(__('messages.add_question'))
@twillRepeaterTitleField('question', ['hidePrefix' => true])
@twillRepeaterGroup('app')

<x-twill::input
  name="question"
  :label="__('messages.question')"
/>

<x-twill::wysiwyg
  name="answer"
  :toolbar-options="[
      ['header' => [3, 4, 5, 6, false]],
      'bold',
      'italic',
      'underline',
      'strike',
      'blockquote',
      'ordered',
      'bullet',
      'hr',
      'code',
      'link',
      'clean',
      'table',
  ]"
  :label="__('messages.answer')"
/>
