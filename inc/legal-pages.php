<?php
/**
 * Built-in legal pages.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

function screenl_legal_pages(): array
{
    $operator_name  = defined('SCREENL_LEGAL_OPERATOR_NAME') ? SCREENL_LEGAL_OPERATOR_NAME : 'SCREENL';
    $operator_email = defined('SCREENL_LEGAL_OPERATOR_EMAIL') ? SCREENL_LEGAL_OPERATOR_EMAIL : 'rent@screenl.ru';
    $operator_phone = defined('SCREENL_LEGAL_OPERATOR_PHONE') ? SCREENL_LEGAL_OPERATOR_PHONE : '+7 999 962 89 99';
    $site_url       = home_url('/');

    return [
        'privacy-policy'       => [
            'title'    => 'Политика конфиденциальности',
            'eyebrow'  => 'Документ SCREENL',
            'lead'     => 'Как мы собираем, используем и защищаем данные, которые вы оставляете на сайте.',
            'updated'  => 'Редакция от 05.06.2026',
            'sections' => [
                [
                    'title' => '1. Общие положения',
                    'text'  => [
                        'Настоящая Политика описывает порядок обработки персональных данных пользователей сайта ' . $site_url . '. Оператором обработки персональных данных является ' . $operator_name . '.',
                        'Политика применяется к данным, которые пользователь передаёт через формы заявки, а также к техническим данным, автоматически передаваемым браузером при посещении сайта.',
                    ],
                ],
                [
                    'title' => '2. Какие данные обрабатываются',
                    'list'  => [
                        'имя пользователя;',
                        'телефон, e-mail или иной контакт, указанный в форме;',
                        'выбранный способ связи: телефон, почта, Telegram, MAX;',
                        'технические данные: IP-адрес, URL страницы, дата и время отправки заявки, сведения, переданные браузером.',
                    ],
                ],
                [
                    'title' => '3. Цели обработки',
                    'list'  => [
                        'обработка заявки и обратная связь с пользователем;',
                        'подбор конфигурации LED-пилонов и подготовка расчёта;',
                        'ведение переписки по запросу пользователя;',
                        'обеспечение работы сайта, защита от злоупотреблений и выполнение требований законодательства РФ.',
                    ],
                ],
                [
                    'title' => '4. Правовые основания и порядок обработки',
                    'text'  => [
                        'Данные обрабатываются на основании согласия пользователя, выраженного отправкой формы на сайте, а также в случаях, предусмотренных законодательством РФ.',
                        'Оператор может выполнять сбор, запись, систематизацию, хранение, уточнение, использование, передачу в рамках исполнения заявки, обезличивание, блокирование, удаление и уничтожение персональных данных.',
                    ],
                ],
                [
                    'title' => '5. Передача третьим лицам',
                    'text'  => [
                        'Оператор не продаёт персональные данные. Данные могут передаваться хостинг-провайдеру, почтовым и техническим сервисам, а также иным лицам, привлечённым для обработки заявки, если это необходимо для целей обработки.',
                        'Передача также возможна по законному требованию государственных органов или суда.',
                    ],
                ],
                [
                    'title' => '6. Срок хранения и отзыв согласия',
                    'text'  => [
                        'Данные хранятся до достижения целей обработки, отзыва согласия или до истечения сроков, предусмотренных законодательством РФ.',
                        'Пользователь может отозвать согласие или запросить уточнение, блокирование либо удаление данных, направив обращение на ' . $operator_email . '.',
                    ],
                ],
                [
                    'title' => '7. Контакты оператора',
                    'text'  => [
                        'По вопросам обработки персональных данных можно обратиться по e-mail ' . $operator_email . ' или телефону ' . $operator_phone . '.',
                    ],
                ],
            ],
        ],
        'personal-data-consent' => [
            'title'    => 'Согласие на обработку персональных данных',
            'eyebrow'  => 'Документ SCREENL',
            'lead'     => 'Условия согласия, которое пользователь предоставляет при отправке формы заявки.',
            'updated'  => 'Редакция от 05.06.2026',
            'sections' => [
                [
                    'title' => '1. Согласие пользователя',
                    'text'  => [
                        'Заполняя форму на сайте ' . $site_url . ' и нажимая кнопку «Получить расчёт», пользователь свободно, своей волей и в своём интересе даёт ' . $operator_name . ' согласие на обработку своих персональных данных.',
                        'Согласие действует в отношении данных, которые пользователь указывает в форме заявки.',
                    ],
                ],
                [
                    'title' => '2. Перечень данных',
                    'list'  => [
                        'имя;',
                        'номер телефона, e-mail или иной контакт для связи;',
                        'выбранный мессенджер или способ связи;',
                        'технические сведения об отправке заявки: дата, время, IP-адрес, URL страницы.',
                    ],
                ],
                [
                    'title' => '3. Цели обработки',
                    'list'  => [
                        'связь с пользователем по его заявке;',
                        'подготовка коммерческого предложения или расчёта;',
                        'уточнение деталей события, конфигурации оборудования и условий аренды;',
                        'ведение внутреннего учёта обращений.',
                    ],
                ],
                [
                    'title' => '4. Действия с персональными данными',
                    'text'  => [
                        'Пользователь разрешает сбор, запись, систематизацию, накопление, хранение, уточнение, использование, передачу лицам, привлечённым для обработки заявки, обезличивание, блокирование, удаление и уничтожение персональных данных.',
                        'Обработка может выполняться с использованием средств автоматизации и без их использования.',
                    ],
                ],
                [
                    'title' => '5. Срок действия и отзыв',
                    'text'  => [
                        'Согласие действует до достижения целей обработки или до его отзыва пользователем.',
                        'Отозвать согласие можно письмом на ' . $operator_email . '. После получения отзыва оператор прекращает обработку и уничтожает данные, если отсутствуют иные законные основания для обработки.',
                    ],
                ],
                [
                    'title' => '6. Связанные документы',
                    'text'  => [
                        'Подробный порядок обработки данных описан в Политике конфиденциальности, размещённой на сайте.',
                    ],
                ],
            ],
        ],
    ];
}

function screenl_legal_url(string $key): string
{
    $pages = screenl_legal_pages();
    $slug  = isset($pages[$key]) ? $key : 'privacy-policy';

    return home_url('/' . $slug . '/');
}

function screenl_current_request_path(): string
{
    $request_uri = isset($_SERVER['REQUEST_URI']) ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])) : '';
    $path        = (string) parse_url($request_uri, PHP_URL_PATH);

    return trim($path, '/');
}

function screenl_get_legal_page_key(): string
{
    $path  = screenl_current_request_path();
    $pages = screenl_legal_pages();

    if (isset($pages[$path])) {
        return $path;
    }

    $segments = array_filter(explode('/', $path));
    $slug     = $segments ? end($segments) : '';

    return isset($pages[$slug]) ? (string) $slug : '';
}

function screenl_is_legal_page_request(): bool
{
    return screenl_get_legal_page_key() !== '';
}

function screenl_render_legal_page(string $key): void
{
    $pages = screenl_legal_pages();
    if (empty($pages[$key])) {
        return;
    }

    $page = $pages[$key];
    ?>
    <main class="legal-page">
        <div class="legal-page__bg" aria-hidden="true">
            <img class="legal-page__bg-img" src="<?php echo screenl_asset('shared/section-bg-gradient-primary.png'); ?>" alt="">
        </div>
        <?php get_template_part('template-parts/layout/site-header'); ?>
        <div class="legal-page__canvas">
            <section class="legal-page__hero">
                <p class="legal-page__eyebrow"><?php echo esc_html($page['eyebrow']); ?></p>
                <h1 class="legal-page__title"><?php echo esc_html($page['title']); ?></h1>
                <p class="legal-page__lead"><?php echo esc_html($page['lead']); ?></p>
            </section>

            <div class="legal-page__layout">
                <aside class="legal-page__aside">
                    <p class="legal-page__aside-label">Статус</p>
                    <p class="legal-page__aside-value"><?php echo esc_html($page['updated']); ?></p>
                    <a class="legal-page__aside-link" href="mailto:rent@screenl.ru">rent@screenl.ru</a>
                </aside>

                <article class="legal-page__content">
                    <?php foreach ($page['sections'] as $section) : ?>
                        <section class="legal-page__section">
                            <h2><?php echo esc_html($section['title']); ?></h2>
                            <?php if (!empty($section['text'])) : ?>
                                <?php foreach ($section['text'] as $paragraph) : ?>
                                    <p><?php echo esc_html($paragraph); ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (!empty($section['list'])) : ?>
                                <ul>
                                    <?php foreach ($section['list'] as $item) : ?>
                                        <li><?php echo esc_html($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </section>
                    <?php endforeach; ?>
                </article>
            </div>
        </div>
    </main>
    <?php
}

add_action('template_redirect', function (): void {
    $key = screenl_get_legal_page_key();
    if ($key === '') {
        return;
    }

    global $wp_query;
    if ($wp_query) {
        $wp_query->is_404 = false;
    }

    status_header(200);
    get_header();
    screenl_render_legal_page($key);
    get_template_part('template-parts/overlays/menu');
    get_footer();
    exit;
}, 0);

add_filter('document_title_parts', function (array $parts): array {
    $key = screenl_get_legal_page_key();
    if ($key === '') {
        return $parts;
    }

    $pages          = screenl_legal_pages();
    $parts['title'] = $pages[$key]['title'];

    return $parts;
});

add_filter('body_class', function (array $classes): array {
    if (screenl_is_legal_page_request()) {
        $classes[] = 'screenl-legal-page';
    }

    return $classes;
});
