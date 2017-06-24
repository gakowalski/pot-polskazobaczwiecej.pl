<?php
defined('_JEXEC') or die;

$app      = JFactory::getApplication();
$user     = JFactory::getUser();
$doc      = JFactory::getDocument();
$menu     = $app->getMenu();
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
$cookie   = $app->input->cookie;

$high_contrast_enabled = $cookie->get($name = 'high_contrast', $defaultValue = false);

if (isset($_GET['toggle_contrast'])) {
  $high_contrast_enabled = !$high_contrast_enabled;
  $cookie->set($name = 'high_contrast', $value = $high_contrast_enabled, $expire = 0);
}

$template_path = $this->baseurl.'/templates/'.$this->template;

$this->setGenerator(null);
$this->setHtml5(true);

// $doc->addScript($template_path . '/js/.js');

$doc->addStyleSheet($template_path . '/css/normalize.css');
$doc->addStyleSheet($template_path . '/css/style.css');

$body_classes =
  'site '
  . $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
  . ($this->direction === 'rtl' ? ' rtl' : '')
  . ($high_contrast_enabled == true? ' high-contrast' : ' low-contrast');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
</head>
<body class="<?php echo $body_classes; ?>">
  <a id="page"></a>

  <header>
    <div class="pzw-template-inside">
      <h1 id="header-logo">
        <a href="<?php echo JUri::base(); ?>" title="Strona główna"><?php echo $sitename; ?></a>
      </h1>
      <div id="header-modules">

        <div>
          <a href="https://www.facebook.com/WeekendNizszychCen/">
            <div id="facebook-logo" alt="Polska Zobacz Więcej na Facebooku"></div>
          </a>
        </div>

        <?php /* mod_search */ ?>
        <jdoc:include type="modules" name="header" style="none" />

        <div id="contrast">
          <a href="<?php echo JUri::current(); ?>?toggle_contrast=true">Wersja <?php echo $high_contrast_enabled == true ? 'graficzna' : 'kontrastowa'; ?></a>
        </div>

      </div>
    </div>
  </header>

  <?php if ($this->countModules('nav')): ?>
  <nav role="navigation">
    <div class="pzw-template-inside">
      <jdoc:include type="modules" name="nav" style="none" />
    </div>
  </nav>
  <?php endif; ?>

  <?php if ($this->countModules('banner')): ?>
  <section id="banner" role="banner">
    <jdoc:include type="modules" name="banner" style="none" />
  </section>
  <?php endif; ?>

  <main role="main">
    <jdoc:include type="message" />
    <div class="pzw-template-inside">
        <?php if ($this->countModules('breadcrumbs')): ?>
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
    </div>
  </footer>
  <?php endif; ?>

  <div id="back-to-top"><a href="#page"><i></i><span>do góry</span></a></div>

  <jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
