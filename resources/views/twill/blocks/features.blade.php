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
