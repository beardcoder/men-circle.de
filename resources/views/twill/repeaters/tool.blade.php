@twillRepeaterTitle(__('messages.tool'))
@twillRepeaterTrigger(__('messages.add_tool'))
@twillRepeaterTitleField('title', ['hidePrefix' => true])
@twillRepeaterGroup('app')

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
  name="tool_image"
  :label="__('messages.cover')"
/>
