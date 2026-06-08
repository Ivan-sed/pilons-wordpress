<?php
/**
 * Section: FAQ
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

$faq_columns = [
    [
        [
            'question' => 'Сколько времени занимает монтаж/демонтаж пилона?',
            'answer'   => [
                'До 60 минут — это значительно сокращает время подготовки площадки и ',
                ['text' => 'оптимизирует бюджет', 'accent' => true],
                ' на установку и демонтаж оборудования',
            ],
            'open'     => true,
        ],
        [
            'question' => 'Что нужно от площадки для установки?',
            'answer'   => ['Только розетка и свободное пространство по размерам пилона'],
        ],
        [
            'question' => 'Нужен ли Wi-Fi на площадке?',
            'answer'   => ['Нет. Подключение осуществляется через встроенный Wi-Fi-модуль пилона — работает стабильно без зависимости от сети площадки'],
        ],
        [
            'question' => 'Можно ли использовать пилон на улице?',
            'answer'   => ['Нет. Пилоны SCREENL предназначены только для использования в помещениях. Это гарантирует идеальное качество изображения и безопасность эксплуатации'],
        ],
        [
            'question' => 'Как управлять контентом во время мероприятия?',
            'answer'   => [
                'Можно менять контент вручную ',
                ['text' => 'с планшета', 'accent' => true],
                ' или ',
                ['text' => 'задать автоматическую смену по расписанию', 'accent' => true],
            ],
        ],
        [
            'question' => 'Какие форматы видео поддерживаются?',
            'answer'   => ['MP4 и прямые трансляции'],
        ],
    ],
    [
        [
            'question' => 'Можно ли объединять несколько пилонов?',
            'answer'   => [
                'Да. Пилоны соединяются ',
                ['text' => 'бесшовно в любые конфигурации,', 'accent' => true],
                ' а также можно ',
                ['text' => 'легко менять компоновку уже после установки', 'accent' => true],
                ' — под задачи конкретной площадки или сценария мероприятия',
            ],
        ],
        [
            'question' => 'Нужен ли наш персонал на монтаже?',
            'answer'   => [
                'Нет. ',
                ['text' => 'Команда SCREENL делает всё под ключ:', 'accent' => true],
                ' доставка, сборка, подключение, сопровождение и демонтаж',
            ],
        ],
        [
            'question' => 'Есть ли помощь с контентом или дизайном?',
            'answer'   => ['Да. Мы можем адаптировать или создать контент под формат и разрешение пилона'],
        ],
        [
            'question' => 'Работаете ли вы по безналичному расчёту?',
            'answer'   => ['Да. Доступны все формы оплаты — для физических и юридических лиц'],
        ],
        [
            'question' => 'Можно ли менять высоту пилона?',
            'answer'   => [
                'Нет. Высота пилона - ',
                ['text' => '200 см.', 'accent' => true],
                ' При необходимости пилон можно приподнять с помощью подставки - ',
                ['text' => 'на 20-60 см', 'accent' => true],
            ],
        ],
    ],
];

$faq_index = 1;
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
                <?php foreach ($faq_columns as $column) : ?>
                    <div class="faq__column">
                        <?php foreach ($column as $item) : ?>
                            <?php
                            $is_open     = !empty($item['open']);
                            $question_id = 'faq-q-' . $faq_index;
                            $answer_id   = 'faq-a-' . $faq_index;
                            ?>
                            <div class="faq__item<?php echo $is_open ? ' faq__item--open' : ''; ?>">
                                <h3 class="faq__question">
                                    <button type="button" class="faq__trigger" id="<?php echo esc_attr($question_id); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($answer_id); ?>">
                                        <?php echo esc_html($item['question']); ?>
                                        <span class="faq__icon" aria-hidden="true"></span>
                                    </button>
                                </h3>
                                <div class="faq__panel" id="<?php echo esc_attr($answer_id); ?>" aria-labelledby="<?php echo esc_attr($question_id); ?>"<?php echo $is_open ? '' : ' hidden'; ?>>
                                    <div class="faq__panel-inner">
                                        <p class="faq__answer">
                                            <?php foreach ($item['answer'] as $part) : ?>
                                                <?php if (is_array($part) && !empty($part['accent'])) : ?>
                                                    <span class="faq__answer-accent"><?php echo esc_html($part['text']); ?></span>
                                                <?php else : ?>
                                                    <?php echo esc_html(is_array($part) ? ($part['text'] ?? '') : $part); ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php ++$faq_index; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
