<?php
defined('_JEXEC') or die;

$app      = JFactory::getApplication();
$user     = JFactory::getUser();
$doc      = JFactory::getDocument();
$lang     = JFactory::getLanguage();
$menu     = $app->getMenu();
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
$cookie   = $app->input->cookie;

$frontpage_enabled = ($menu->getActive() == $menu->getDefault($lang->getTag()));
$high_contrast_enabled = $cookie->get('high_contrast', false);
$cookie_law_message_enabled = $cookie->get('cookie_law_message', true) == true;
$font_resized = $cookie->get('font_resize', 'small');

if (isset($_GET['toggle_contrast'])) {
  $high_contrast_enabled = !$high_contrast_enabled;
  $cookie->set('high_contrast', $high_contrast_enabled, 0);
}
if (isset($_GET['font_resize'])) {
  $font_resized = $_GET['font_resize'];
  $cookie->set('font_resize', $font_resized, 0);
}
if ($cookie_law_message_enabled) {
  $cookie->set('cookie_law_message', 0, 0);
}

$template_path = $this->baseurl.'/templates/'.$this->template;

$this->setGenerator(null);
$this->setHtml5(true);

$doc->addStyleSheet($template_path . '/css/normalize.css');
$doc->addStyleSheet($template_path . '/css/style.css?ver=' . filemtime('templates/'.$this->template.'/css/style.css'));
$doc->addStyleSheet($template_path . '/css/animate.min.css');

$doc->addScript($template_path . '/js/countUp.js');
$doc->addScript($template_path . '/js/countUp-jquery.js');
$doc->addScript($template_path . '/js/morphext.min.js');
$doc->addScript($template_path . '/js/default.js');

$body_classes =
  "site $option view-$view"
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
  . ($this->direction === 'rtl' ? ' rtl' : '')
  . ($high_contrast_enabled == true? ' high-contrast' : ' low-contrast')
  . ($frontpage_enabled == true? ' frontpage' : ' not-frontpage');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
  <?php if ($font_resized != 'small'): ?>
  <style>html { font-size: <?php echo ($font_resized == 'medium' ? 12 : 14); ?>px; }</style>
  <?php endif; ?>
</head>
<body class="<?php echo $body_classes; ?>">
  <a id="page"></a>

  <h1 id="header-logo">
    <a href="<?php echo JUri::base(); ?>" title="Strona główna"><img src="<?php echo $template_path; ?>/images/pzw-logo-jesien-2019.png">
      <span class="hidden-text"><?php echo $sitename; ?></span></a>
  </h1>

  <header>
    <div id="header-modules">
      <div>
        <a target="_blank" href="https://www.facebook.com/WeekendNizszychCen/">
          <div id="facebook-logo"></div>
          <span class="hidden-text">POLSKA ZOBACZ WIĘCEJ - WEKEND ZA PÓŁ CENY na Facebooku</span>
        </a>
      </div>

      <div id="font-resize">
        <a id="font-resize-small" href="<?php echo JUri::current(); ?>?font_resize=small">
          <span class="hidden-text">Czcionka normalna</span>
        </a>
        <a id="font-resize-medium" href="<?php echo JUri::current(); ?>?font_resize=medium">
          <span class="hidden-text">Czcionka średnia</span>
        </a>
        <a id="font-resize-large" href="<?php echo JUri::current(); ?>?font_resize=large">
          <span class="hidden-text">Czcionka duża</span>
        </a>
      </div>

      <div id="contrast">
        <a href="<?php echo JUri::current(); ?>?toggle_contrast=true">
          <span class="hidden-text">Wersja <?php echo $high_contrast_enabled == true ? 'graficzna' : 'kontrastowa'; ?><span>
        </a>
      </div>

      <?php if ($this->countModules('nav')): ?>
      <nav role="navigation">
          <jdoc:include type="modules" name="nav" style="none" />
      </nav>
      <?php endif; ?>

      <jdoc:include type="modules" name="header" style="none" />

      <div id="header-organizers">
        <div>
          <a class="logo msit" href="https://www.msit.gov.pl/"><img src="<?php echo $template_path; ?>/images/logo-msit.png"></a>
          <a class="logo pot" href="https://www.polska.travel/pl"><img src="<?php echo $template_path; ?>/images/logo-pot-pl.svg"></a>
        </div>
      </div>

    </div>

    <?php if ($high_contrast_enabled): ?>
    <h1><?php echo $sitename; ?></h1>
    <?php endif; ?>
  </header>

  <?php if ($option != 'com_search' && $this->countModules('banner')): ?>
  <section id="banner" role="banner">
    <jdoc:include type="modules" name="banner" style="none" />
  </section>
  <?php endif; ?>

  <main role="main">
    <jdoc:include type="message" />
    <div class="pzw-template-inside">
		    <jdoc:include type="component" />
    </div>
  </main>

  <?php if ($this->countModules('footer-content') + $this->countModules('footer-right-menu') + $this->countModules('footer-bottom-menu')): ?>
  <footer role="contentinfo">
    <!-- <img id="sponsors" src="<?php echo $template_path; ?>/images/logos-sponsors.png"> -->
    <div class="pzw-template-inside">
      <div id="footer-content">
        <jdoc:include type="modules" name="footer-content" style="none" />
        <div id="organizers">
          <!--<div>-->
            <h2>Organizatorzy Akcji:</h2><img src="<?php echo $template_path; ?>/images/logo-pot-borderless.png">
            <img src="<?php echo $template_path; ?>/images/logo-msit.jpg">
          <!--</div>-->
          <!--
          <div>
            <h2>Partner Strategiczny</h2><img src="<?php echo $template_path; ?>/images/logo-lot.jpg">
          </div>
          <div>
            <h2>Partnerzy Promocyjni</h2><img src="<?php echo $template_path; ?>/images/logo-intercity.png">
            <img src="<?php echo $template_path; ?>/images/logo-polonus.png">
          </div>
          -->
        </div>
      </div>
    </div>
    <div id="footer-bottom-menu">
      <jdoc:include type="modules" name="footer-bottom-menu" style="none" />
      <?php if ($high_contrast_enabled): ?>
      <span>Polska Organizacja Turystyczna, ul. Chałubińskiego 8, 00-613 Warszawa, tel. 225367053</span>
      <?php endif; ?>
      <?php if ($cookie_law_message_enabled === true): ?>
      <p>
        Strona używa plików cookies, aby ułatwić Tobie korzystanie z serwisu oraz do celów statystycznych. Jeśli nie blokujesz tych plików, to zgadzasz się na ich użycie oraz zapisanie w pamięci urządzenia. Pamiętaj, że możesz samodzielnie zarządzać cookies, zmieniając ustawienia przeglądarki. Brak zmiany ustawienia przeglądarki oznacza wyrażenie zgody.
      </p>
      <?php endif; ?>
    </div>
  </footer>
  <?php endif; ?>

  <div id="back-to-top"><a href="#page"><i></i><span>do góry</span></a></div>

  <jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
