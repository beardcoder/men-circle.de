@twillBlockTitle('Text')
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
  :label="twillTrans('Text')"
  :maxlength="200"
/>

<x-twill::medias
  name="text_image"
  :label="__('messages.cover')"
  field-note="Minimum image width: 1500px"
/>