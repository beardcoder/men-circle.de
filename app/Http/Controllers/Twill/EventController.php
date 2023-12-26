<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\DatePicker;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fieldset;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\Filters\QuickFilter;
use A17\Twill\Services\Listings\Filters\QuickFilters;
use A17\Twill\Services\Listings\TableColumns;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;

class EventController extends BaseModuleController
{
  protected $moduleName = 'events';

  /**
   * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
   */
  protected function setUpController(): void
  {
    // $this->setPermalinkBase('event');
  }

  protected function formData($request)
  {
    if ($request->route('event')) {
      return [
        'customPermalink' => route('event.show', ['id' => $request->route('event')]),
      ];
    }
    return [];
  }

  /**
   * See the table builder docs for more information. If you remove this method you can use the blade files.
   * When using twill:module:make you can specify --bladeForm to use a blade form instead.
   */
  public function getForm(TwillModelContract $model): Form
  {
    $form = parent::getForm($model);
    $form->add(
      DatePicker::make()
        ->name('date')
        ->label('Datum')
        ->time24h()
        ->required(),
    );
    $form->add(
      Medias::make()
        ->name('event')
        ->label(twillTrans('Cover image'))
        ->max(1),
    );

    $form->add(
      Input::make()
        ->name('list')
        ->label(twillTrans('Email Liste'))
        ->type('number'),
    );

    $form->add(BlockEditor::make());

    $form->addFieldset(
      Fieldset::make()
        ->title('Anmeldungen')
        ->fields([
          InlineRepeater::make()
            ->name('event_registrations')
            ->triggerText('Anmeldung hinzufügen')
            ->label('Anmeldung')
            ->fields([Input::make()->name('name'), Input::make()->name('email')]),
        ]),
    );

    return $form;
  }

  public function getCreateForm(): Form
  {
    $form = parent::getCreateForm();

    $form->add(
      Input::make()
        ->name('title')
        ->label('Titel'),
    );

    $form->add(
      DatePicker::make()
        ->name('date')
        ->label('Datum')
        ->time24h()
        ->required(),
    );

    return $form;
  }

  /**
   * This is an example and can be removed if no modifications are needed to the table.
   */
  protected function additionalIndexTableColumns(): TableColumns
  {
    $table = parent::additionalIndexTableColumns();

    $table->push(
      Text::make()
        ->field('date')
        ->title('Datum')
        ->customRender(function (Event $model) {
          return view('backend.table.date', [
            'date' => $model->date,
          ])->render();
        })
        ->sortable(true),
    );

    return $table;
  }

  public function quickFilters(): QuickFilters
  {
    $filters = QuickFilters::make();

    $filters->add(
      QuickFilter::make()
        ->queryString('next')
        ->label('Bevorstehende')
        ->amount(fn() => $this->repository->whereDate('date', '>=', date('Y-m-d G:i:s'))->count())
        ->apply(fn(Builder $builder) => $builder->whereDate('date', '>=', date('Y-m-d G:i:s'))),
    );

    $filters->add(
      QuickFilter::make()
        ->queryString('all')
        ->label('Alle'),
    );

    return $filters;
  }
}
