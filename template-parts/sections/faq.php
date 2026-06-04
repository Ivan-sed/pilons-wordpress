<?php
/**
 * Section: faq
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
        <!-- FAQ -->
        <section class="faq" id="faq" aria-labelledby="faq-title">
            <header class="faq__header">
                <hgroup class="faq__intro">
                    <h2 class="faq__title" id="faq-title">FAQ</h2>
                    <p class="faq__subtitle">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века</p>
                </hgroup>
                <button type="button" class="faq__cta" data-modal-open>Получить расчет</button>
            </header>
            <div class="faq__body">
                <div class="faq__column">
                    <div class="faq__item faq__item--open">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-1" aria-expanded="true" aria-controls="faq-a-1">
                                Сколько времени занимает монтаж/демонтаж пилона?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-1" aria-labelledby="faq-q-1">
                            <div class="faq__panel-inner">
                                <p class="faq__answer">До 60 минут это значительно сокращает время подготовки площадки и <span class="faq__answer-accent">оптимизирует бюджет</span> на установку и демонтаж оборудования</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-2" aria-expanded="false" aria-controls="faq-a-2">
                                Что нужно от площадки для установки?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-2" aria-labelledby="faq-q-2" hidden>
                            <div class="faq__panel-inner">
                                <p class="faq__answer">Только ровная поверхность и доступ к электросети. Пилоны стоят на стойках, не требуют крепления к полу или потолку</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-3" aria-expanded="false" aria-controls="faq-a-3">
                                Нужен ли Wi-Fi на площадке?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-3" aria-labelledby="faq-q-3" hidden>
                            <div class="faq__panel-inner">
                                <p class="faq__answer">Нет, пилоны работают автономно. Управление осуществляется через планшет по локальной сети или напрямую через кабель</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-4" aria-expanded="false" aria-controls="faq-a-4">
                                Можно ли использовать пилон на улице?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-4" aria-labelledby="faq-q-4" hidden>
                            <div class="faq__panel-inner">
                                <p class="faq__answer">Да, при условии защиты от осадков и ветра. У нас есть специальные комплекты для уличной эксплуатации</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-5" aria-expanded="false" aria-controls="faq-a-5">
                                Работаете ли вы по безналичному расчёту?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-5" aria-labelledby="faq-q-5" hidden>
                            <div class="faq__panel-inner">
                                <p class="faq__answer">Да, работаем с юридическими и физическими лицами. Предоставляем полный пакет документов для бухгалтерии</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq__column">
                    <div class="faq__item">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-6" aria-expanded="false" aria-controls="faq-a-6">
                                Как управлять контентом во время мероприятия?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-6" aria-labelledby="faq-q-6" hidden>
                            <div class="faq__panel-inner">
                                <p class="faq__answer">Через планшет или ноутбук. Можно менять плейлисты, тексты и видео в реальном времени</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-7" aria-expanded="false" aria-controls="faq-a-7">
                                Какие форматы видео поддерживаются?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-7" aria-labelledby="faq-q-7" hidden>
                            <div class="faq__panel-inner">
                                <p class="faq__answer">MP4, MOV, AVI. Рекомендуем разрешение Full HD или 4K для лучшего качества</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-8" aria-expanded="false" aria-controls="faq-a-8">
                                Можно ли объединять несколько пилонов?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-8" aria-labelledby="faq-q-8" hidden>
                            <div class="faq__panel-inner">
                                <p class="faq__answer">Да, можно создавать видеостены любой конфигурации. Бесшовное соединение обеспечивает единое полотно</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__question">
                            <button type="button" class="faq__trigger" id="faq-q-9" aria-expanded="false" aria-controls="faq-a-9">
                                Есть ли помощь с контентом или дизайном?
                                <span class="faq__icon" aria-hidden="true"></span>
                            </button>
                        </h3>
                        <div class="faq__panel" id="faq-a-9" aria-labelledby="faq-q-9" hidden>
                            <div class="faq__panel-inner">
                                <p class="faq__answer">Да, наши дизайнеры адаптируют ваши материалы или создадут контент с нуля под задачи мероприятия</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
