<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Columns;
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
    $this->enableDuplicate();
  }

  protected function formData($request)
  {
    if ($request->route('event')) {
      return [
        'customPermalink' => route('event.show', ['event' => $request->route('event')]),
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
      Medias::make()
        ->name('event')
        ->label(twillTrans('Cover image'))
        ->max(1),
    );
    $form->add(
      Input::make()
        ->name('description')
        ->label(twillTrans('Beschreibung'))
        ->required(),
    );
    $form->add(
      Input::make()
        ->name('list')
        ->label(twillTrans('Email Liste'))
        ->type('number'),
    );

    $form->add(
      Input::make()
        ->name('place')
        ->label(twillTrans('Ort')),
    );

    $form->add(
      Columns::make()
        ->left([
          Input::make()
            ->name('latitude')
            ->label(twillTrans('Latitude'))
            ->type('number'),
        ])
        ->right([
          Input::make()
            ->name('longitude')
            ->label(twillTrans('Longitude'))
            ->type('number'),
        ]),
    );

    $form->add(
      Columns::make()
        ->left([
          DatePicker::make()
            ->name('startDate')
            ->label(twillTrans('Start Datum'))
            ->time24h()
            ->required(),
        ])
        ->right([
          DatePicker::make()
            ->name('endDate')
            ->label(twillTrans('End Datum'))
            ->time24h()
            ->required(),
        ]),
    );

    $form->addFieldset(
      Fieldset::make()
        ->title(twillTrans('Ort'))
        ->fields([
          Columns::make()
            ->left([
              Input::make()
                ->name('postalCode')
                ->label(twillTrans('Postleitzahl'))
                ->required(),
            ])
            ->right([
              Input::make()
                ->name('addressLocality')
                ->label(twillTrans('Ort'))
                ->required(),
            ]),
          Input::make()
            ->name('streetAddress')
            ->label(twillTrans('Straße und Hausnummer'))
            ->required(),
        ]),
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
        ->name('startDate')
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
        ->field('startDate')
        ->title('Datum')
        ->customRender(function (Event $model) {
          return view('backend.table.date', [
            'date' => $model->startDate,
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
        ->amount(fn() => $this->repository->whereDate('startDate', '>=', date('Y-m-d G:i:s'))->count())
        ->apply(fn(Builder $builder) => $builder->whereDate('startDate', '>=', date('Y-m-d G:i:s'))),
    );

    $filters->add(
      QuickFilter::make()
        ->queryString('all')
        ->label('Alle'),
    );

    return $filters;
  }
}
