@twillBlockTitle(__('messages.features'))
@twillBlockIcon('b-grid')
@twillBlockGroup('app')

<x-twill::input
  name="title"
  :label="__('messages.title')"
/>

<x-twill::input
  name="text"
  :label="__('messages.text')"
/>

<x-twill::repeater type="feature" />

<x-twill::checkbox
  name="background"
  :label="__('messages.background')"
/>

<x-twill::input
  name="anchor"
  :label="__('messages.anchor')"
/>
