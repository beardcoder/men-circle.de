@twillBlockTitle(__('messages.about'))
@twillBlockIcon('b-people')
@twillBlockGroup('app')

<x-twill::input
  name="title"
  :label="__('messages.title')"
/>

<x-twill::input
  name="name"
  :label="__('messages.name')"
/>

<x-twill::wysiwyg
  name="text"
  :label="__('messages.text')"
/>

<x-twill::medias
  name="cover"
  :label="__('messages.cover')"
  field-note="Minimum image width: 1500px"
/>
