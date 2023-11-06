@twillBlockTitle('Homepage')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::browser
  name="page"
  label="Select the homepage"
  module-name="pages"
/>

<x-twill::input
  name="footer"
  :label="__('messages.footer')"
/>
