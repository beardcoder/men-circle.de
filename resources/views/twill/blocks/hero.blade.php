@twillBlockTitle(__('messages.hero'))
@twillBlockIcon('b-image')
@twillBlockGroup('app')

<x-twill::input
  name="title"
  :label="twillTrans('Title')"
/>

<x-twill::wysiwyg
  name="text"
  :label="twillTrans('Text')"
  :maxlength="200"
/>

<x-twill::medias
  name="hero"
  :label="__('messages.cover')"
  field-note="Minimum image width: 1500px"
/>

<x-twill::checkbox
  name="background"
  :label="__('messages.background')"
/>

<x-twill::input
  name="anchor"
  :label="__('messages.anchor')"
/>
