@twillBlockTitle(__('messages.contact'))
@twillBlockIcon('b-mail')
@twillBlockGroup('app')

<x-twill::input
  name="title"
  :label="__('messages.title')"
/>

<x-twill::input
  name="text"
  :label="__('messages.text')"
/>
