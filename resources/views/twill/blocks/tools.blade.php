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
