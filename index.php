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
$high_contrast_enabled = $cookie->get($name = 'high_contrast', $defaultValue = false);
$font_resized = $cookie->get($name = 'font_resize', $defaultValue = 'small');

if (isset($_GET['toggle_contrast'])) {
  $high_contrast_enabled = !$high_contrast_enabled;
  $cookie->set('high_contrast', $high_contrast_enabled, $expire = 0);
}
if (isset($_GET['font_resize'])) {
  $font_resized = $_GET['font_resize'];
  $cookie->set('font_resize', $font_resized, $expire = 0);
}

$template_path = $this->baseurl.'/templates/'.$this->template;

$this->setGenerator(null);
$this->setHtml5(true);

$doc->addStyleSheet($template_path . '/css/normalize.css');
$doc->addStyleSheet($template_path . '/css/style.css');

$doc->addScript($template_path . '/js/default.js');

$body_classes =
  'site '
  . $option
	. ' view-' . $view
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
  <style>html { font-size: <?php echo ($font_resized == 'medium' ? 13 : 16); ?>px; }</style>
  <?php endif; ?>
</head>
<body class="<?php echo $body_classes; ?>">
  <a id="page"></a>

  <header>
    <div class="pzw-template-inside">
      <?php if ($high_contrast_enabled == false): ?>
      <h1 id="header-logo">
        <a href="<?php echo JUri::base(); ?>" title="Strona główna"><?php echo $sitename; ?></a>
      </h1>
      <?php endif; ?>

      <div id="header-modules">

        <div>
          <a href="https://www.facebook.com/WeekendNizszychCen/">
            <div id="facebook-logo"></div>
            <span class="hidden-text">Polska Zobacz Więcej na Facebooku</span>
          </a>
        </div>

        <?php if ($high_contrast_enabled == false): ?>
        <jdoc:include type="modules" name="header" style="none" />
        <?php endif; ?>

        <div id="font-resize">
          <a id="font-resize-small" href="<?php echo JUri::current(); ?>?font_resize=small">
            <span>Czcionka normalna</span>
          </a>
          <a id="font-resize-medium" href="<?php echo JUri::current(); ?>?font_resize=medium">
            <span>Czcionka średnia</span>
          </a>
          <a id="font-resize-large" href="<?php echo JUri::current(); ?>?font_resize=large">
            <span>Czcionka duża</span>
          </a>
        </div>

        <div id="contrast">
          <a href="<?php echo JUri::current(); ?>?toggle_contrast=true">Wersja <?php echo $high_contrast_enabled == true ? 'graficzna' : 'kontrastowa'; ?></a>
        </div>

      </div>
    </div>

    <?php if ($high_contrast_enabled): ?>
    <h1><?php echo $sitename; ?></h1>
    <?php endif; ?>
  </header>

  <?php if ($this->countModules('nav')): ?>
  <input id="mobile-menu-checkbox" type="checkbox">
  <label id="mobile-menu-label" for="mobile-menu-checkbox">Menu</label>
  <nav role="navigation">
    <?php if ($high_contrast_enabled): ?>
    <jdoc:include type="modules" name="header" style="none" />
    <?php endif; ?>
    <div class="pzw-template-inside">
      <jdoc:include type="modules" name="nav" style="none" />
    </div>
  </nav>
  <?php endif; ?>

  <?php if ($option != 'com_search' && $this->countModules('banner')): ?>
  <section id="banner" role="banner">
    <jdoc:include type="modules" name="banner" style="none" />
  </section>
  <?php endif; ?>

  <main role="main">
    <jdoc:include type="message" />
    <div class="pzw-template-inside">
        <?php if ($frontpage_enabled == false && $this->countModules('breadcrumbs')): ?>
        <div id="breadcrumbs">
          <jdoc:include type="modules" name="breadcrumbs" style="none" />
        </div>
        <?php endif; ?>
		    <jdoc:include type="component" />
    </div>
  </main>

  <?php if ($this->countModules('aside')): ?>
  <aside>
    <jdoc:include type="modules" name="aside" style="none" />
  </aside>
  <?php endif; ?>

  <?php if ($this->countModules('footer-content') + $this->countModules('footer-right-menu') + $this->countModules('footer-bottom-menu')): ?>
  <footer role="contentinfo">
    <div class="pzw-template-inside">
      <div id="footer-content">
        <jdoc:include type="modules" name="footer-content" style="none" />
      </div>
      <div id="footer-right-menu">
        <jdoc:include type="modules" name="footer-right-menu" style="none" />
      </div>
    </div>
    <div id="footer-bottom-menu">
      <jdoc:include type="modules" name="footer-bottom-menu" style="none" />
      <?php if ($high_contrast_enabled): ?>
      <span>Polska Organizacja Turystyczna, ul. Chałubińskiego 8, 00-613 Warszawa, tel. 225367053</span>
      <?php endif; ?>
    </div>
  </footer>
  <?php endif; ?>

  <?php //if ($high_contrast_enabled == false): ?>
  <div id="back-to-top"><a href="#page"><i></i><span>do góry</span></a></div>
  <?php //endif; ?>

  <jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
