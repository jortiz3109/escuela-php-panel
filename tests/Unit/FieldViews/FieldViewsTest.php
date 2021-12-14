<?php

namespace Tests\Unit\FieldViews;

use App\FieldViews\DateView;
use App\FieldViews\EnabledView;
use App\FieldViews\FieldView;
use App\FieldViews\ImageView;
use App\FieldViews\TextView;
use App\FieldViews\UrlView;
use Tests\TestCase;

class FieldViewsTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test_must_render_view($viewClass, $label, $value): void
    {
        /** @var FieldView $view */
        $view = new $viewClass($label, $value);
        $this->assertStringContainsString($label, $view->render()->toHtml());
        $this->assertStringContainsString($value, $view->render()->toHtml());
    }

    public function test_must_render_enabled_view(): void
    {
        $view = new EnabledView('Status', true);
        $this->assertStringContainsString('Status', $view->render()->toHtml());
        $this->assertStringContainsString(trans('common.fields.enabled'), $view->render()->toHtml());

        $view = new EnabledView('Status', false);
        $this->assertStringContainsString('Status', $view->render()->toHtml());
        $this->assertStringContainsString(trans('common.fields.disabled'), $view->render()->toHtml());
    }

    public function dataProvider(): array
    {
        return [
            'TextView' => [TextView::class, 'Name', 'ExampleName'],
            'DateView' => [DateView::class, 'Date', '2021-01-01'],
            'ImageView' => [ImageView::class, 'Image', 'https://cdn.pixabay.com/photo/2020/05/25/17/21/link-5219567_960_720.jpg'],
            'UrlView' => [UrlView::class, 'Url', 'https://example.com'],
        ];
    }
}
