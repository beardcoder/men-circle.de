@twillRepeaterTitle(__('messages.tool'))
@twillRepeaterTrigger(__('messages.add_tool'))
@twillRepeaterTitleField('title', ['hidePrefix' => true])
@twillRepeaterGroup('app')

<x-twill::input name="title" :label="__('messages.title')" />

<x-twill::wysiwyg name="text" :toolbar-options="[
    ['header' => [3, 4, 5, 6, false]],
    'bold',
    'italic',
    'underline',
    'strike',
    'blockquote',
    'ordered',
    'bullet',
    'hr',
    'code',
    'link',
    'clean',
    'table',
]" :label="__('messages.text')" />

<x-twill::medias name="tool_image" :label="__('messages.cover')" />
