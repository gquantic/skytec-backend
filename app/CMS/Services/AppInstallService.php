<?php

namespace App\CMS\Services;

use App\Models\News\News;
use App\Models\News\NewsCategory;
use Illuminate\Support\Facades\Artisan;

class AppInstallService
{
    public function init()
    {
        $this->makeNewsCategories();
        $this->makeFirstNews();

        Artisan::call('emojis:update');
        Artisan::call('config:base');
        Artisan::call('make:user Admin admin admin@admin.com admin123 --admin');
    }

    private function makeNewsCategories()
    {
        NewsCategory::query()->insert([
            [
                'title' => 'Глобальные новости'
            ],
            [
                'title' => 'Новости SKY'
            ],
        ]);
    }

    private function makeFirstNews()
    {
        News::query()->insert([
            [
                'news_category_id' => 1,
                'title' => 'Как контент становится главным ключом к успеху',
                'content' => 'Подход к персонализации контента становится приоритетным для брендов. Аналитика
                                и данные помогают создавать настраиваемый контент, который удовлетворяет
                                индивидуальные потребности аудитории. Это открывает новые горизонты в
                                маркетинговой стратегии.',
                'active' => 1,
                'moderated' => 1,
            ],
            [
                'news_category_id' => 2,
                'title' => 'Роль видео-контента в маркетинге: влияние и перспективы',
                'content' => 'Видео-контент становится ключевым в сфере маркетинга. Исследования указывают на его огромное влияние на поведение потребителей. Компании активно инвестируют в создание инновационных и привлекательных видеороликов для эффективной рекламы.',
                'active' => 1,
                'moderated' => 1,
            ],
            [
                'news_category_id' => 2,
                'title' => 'Цифровые Технологии В Маркетинге: эволюция взаимодействия',
                'content' => 'Бренды внедряют новейшие технологии для привлечения клиентов. Отмечается рост вовлеченности благодаря умным инструментам и анализу данных. Это открывает новые возможности для персонализации и более глубокого взаимодействия с публикой.',
                'active' => 1,
                'moderated' => 1,
            ],
            [
                'news_category_id' => 1,
                'title' => 'Продвижение в мире медиа',
                'content' => '"Исследование показало: креативные маркетинговые стратегии привлекают внимание потребителей! Эксперты утверждают, что персонализированный контент - ключ к успешной рекламе. Новейшие технологии улучшают взаимодействие между брендами и клиентами, смягчая границы между виртуальным и реальным миром."',
                'active' => 1,
                'moderated' => 1,
            ],
            [
                'news_category_id' => 2,
                'title' => 'Запуск портала',
                'content' => '"Инновационные маркетинговые стратегии подтверждают свою эффективность! Исследования показывают, что акцент на социальных сетях увеличивает вовлеченность аудитории.Персонализация рекламы на основе данных покупателей — главный тренд в современном маркетинге, обеспечивая более тесное взаимодействие между брендами и потребителями."',
                'active' => 1,
                'moderated' => 1,
            ],
        ]);
    }
}
