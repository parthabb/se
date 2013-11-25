<?php

/* welcome.phtml */
class __TwigTemplate_08c9572688fcafc4fa7c180bfc6f7310ebb3376e7a539046facfc2d489914e2e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.phtml");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.phtml";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "  <div align=\"CENTER\">
  <span>Welcome ";
        // line 5
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $_user_, "html", null, true);
        echo "</span>
  <form action=\"\">
    <input type=\"button\" value=\"SUBMIT LEAVE\">
    <input type=\"button\" value=\"VIEW LEAVE\">
    <input type=\"button\" value=\"APPROVE LEAVE\">
  </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "welcome.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 5,  31 => 4,  28 => 3,);
    }
}
