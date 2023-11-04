@twillBlockTitle('Hero')
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
  name="cover"
  :label="twillTrans('Cover Image')"
  field-note="Minimum image width: 1500px"
/>

<x-twill::medias
  name="logo"
  :label="twillTrans('Logo')"
/>
