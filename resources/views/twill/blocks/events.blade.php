@twillBlockTitle('Events')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::input
  name="title"
  :label="twillTrans('Title')"
/>

<x-twill::wysiwyg
  name="text"
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
  :label="__('messages.text')"
/>

<x-twill::checkbox
  name="background"
  :label="__('messages.background')"
/>

<x-twill::input
  name="anchor"
  :label="__('messages.anchor')"
/>
