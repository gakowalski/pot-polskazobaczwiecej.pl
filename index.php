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
    <jdoc:include type="modules" name="header" style="none" />
    <div id="header-separator"></div>
  </header>
  <?php // endif; ?>

  <?php if ($this->countModules('nav')): ?>
  <nav role="navigation">
    <jdoc:include type="modules" name="nav" style="none" />
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

  <?php if ($this->countModules('footer')): ?>
  <footer role="contentinfo">
    <jdoc:include type="modules" name="footer" style="none" />
  </footer>
  <?php endif; ?>

  <jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
