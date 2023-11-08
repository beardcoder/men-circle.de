@twillBlockTitle(__('messages.tools'))
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::input
  name="title"
  :label="__('messages.title')"
/>

<x-twill::input
  name="text"
  :label="__('messages.text')"
/>

<x-twill::repeater type="tool" />

<x-twill::checkbox
  name="background"
  :label="__('messages.background')"
/>

<x-twill::input
  name="anchor"
  :label="__('messages.anchor')"
/>
