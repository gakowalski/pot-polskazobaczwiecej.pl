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
  . ($this->direction === 'rtl' ? ' rtl' : '');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
</head>
<body class="<?php echo $body_classes; ?>">

  <?php // if ($this->countModules('header')): ?>
  <header>
    <div class="pzw-template-inside">
      <h1 id="header-logo">
        <a href="/" title="Strona główna"><?php echo $sitename; ?></a>
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
          <a href="">Wersja kontrastowa</a>
        </div>

      </div>
    </div>
    <div id="header-separator"></div>
  </header>
  <?php // endif; ?>

  <?php if ($this->countModules('nav')): ?>
  <nav role="navigation">
    <div class="pzw-template-inside">
      <jdoc:include type="modules" name="nav" style="none" />
    </div>
  </nav>
  <?php endif; ?>

  <?php if ($this->countModules('banner')): ?>
  <section id="banner" role="banner">
    <jdoc:include type="modules" name="banner" style="xhtml" />
  </section>
  <?php endif; ?>

  <main role="main">
    <jdoc:include type="message" />
		<jdoc:include type="component" />
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
        <?php if ($this->countModules('footer-content')): ?>
        <jdoc:include type="modules" name="footer-content" style="none" />
        <?php else: ?>
        <h3>ORGANIZATOR AKCJI:</h3>
        <div class="logo"><a href="https://pot.gov.pl/"><span>Strona główna Polskiej Organizacji Turystycznej</span></a></div>
        <p>
        <strong>Polska Organizacja Turystyczna</strong>
        ul. Chałubińskiego 8, 00-613 Warszawa<br>
        tel. 22 536 70 53<br>
        <a href="#"><span>Kontakt do nas</span></a>
        </p>
        <?php endif; ?>
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

  <jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
