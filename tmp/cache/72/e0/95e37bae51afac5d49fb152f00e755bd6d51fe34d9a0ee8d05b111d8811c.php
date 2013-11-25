<?php

/* base.phtml */
class __TwigTemplate_72e095e37bae51afac5d49fb152f00e755bd6d51fe34d9a0ee8d05b111d8811c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'js' => array($this, 'block_js'),
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
  <head>
    <title>";
        // line 3
        if (isset($context["pagetitle"])) { $_pagetitle_ = $context["pagetitle"]; } else { $_pagetitle_ = null; }
        echo twig_escape_filter($this->env, $_pagetitle_, "html", null, true);
        echo "</title>
    <link rel=\"stylesheet\" href=\"css/main.css\" />
    ";
        // line 5
        $this->displayBlock('css', $context, $blocks);
        // line 6
        echo "    ";
        $this->displayBlock('js', $context, $blocks);
        // line 7
        echo "  </head>
  <body>

    <div id=\"header\">
      ";
        // line 11
        $this->displayBlock('header', $context, $blocks);
        // line 14
        echo "    </div>

    <div id=\"content\">
      ";
        // line 17
        $this->displayBlock('content', $context, $blocks);
        // line 18
        echo "    </div>

    <div id=\"footer\">
      ";
        // line 21
        $this->displayBlock('footer', $context, $blocks);
        // line 24
        echo "    </div>

    </body>
</html>";
    }

    // line 5
    public function block_css($context, array $blocks = array())
    {
    }

    // line 6
    public function block_js($context, array $blocks = array())
    {
    }

    // line 11
    public function block_header($context, array $blocks = array())
    {
        // line 12
        echo "        ";
        $this->env->loadTemplate("header.html")->display($context);
        // line 13
        echo "      ";
    }

    // line 17
    public function block_content($context, array $blocks = array())
    {
    }

    // line 21
    public function block_footer($context, array $blocks = array())
    {
        // line 22
        echo "        ";
        $this->env->loadTemplate("footer.html")->display($context);
        // line 23
        echo "      ";
    }

    public function getTemplateName()
    {
        return "base.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 23,  96 => 22,  93 => 21,  88 => 17,  84 => 13,  81 => 12,  78 => 11,  73 => 6,  68 => 5,  61 => 24,  59 => 21,  54 => 18,  52 => 17,  47 => 14,  45 => 11,  39 => 7,  36 => 6,  34 => 5,  28 => 3,  24 => 1,);
    }
}
