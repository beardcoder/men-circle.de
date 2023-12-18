@twillRepeaterTitle(__('messages.feature'))
@twillRepeaterTrigger(__('messages.add_feature'))
@twillRepeaterTitleField('title', ['hidePrefix' => true])
@twillRepeaterGroup('app')

<x-twill::input name="title" :label="__('messages.title')" />

<x-twill::input name="text" :label="__('messages.text')" />
