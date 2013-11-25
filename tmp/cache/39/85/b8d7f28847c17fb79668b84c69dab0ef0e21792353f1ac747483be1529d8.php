<?php

/* header.html */
class __TwigTemplate_3985b8d7f28847c17fb79668b84c69dab0ef0e21792353f1ac747483be1529d8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"logout-link\">
  ";
        // line 2
        if (isset($context["pagetitle"])) { $_pagetitle_ = $context["pagetitle"]; } else { $_pagetitle_ = null; }
        if (($_pagetitle_ != "Index")) {
            // line 3
            echo "    <div class=\"right\">
      <span>";
            // line 4
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $_user_, "html", null, true);
            echo "</span> |
      <a href=\"logout\">logout</a>
    </div>
  ";
        }
        // line 8
        echo "</div>

<div class=\"overflow-auto\">
  <h1>Leave Application System</h1>
</div>";
    }

    public function getTemplateName()
    {
        return "header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 8,  28 => 4,  25 => 3,  22 => 2,  19 => 1,);
    }
}
