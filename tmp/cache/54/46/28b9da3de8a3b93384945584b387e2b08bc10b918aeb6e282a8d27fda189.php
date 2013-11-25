<?php

/* index.phtml */
class __TwigTemplate_544628b9da3de8a3b93384945584b387e2b08bc10b918aeb6e282a8d27fda189 extends Twig_Template
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
        echo "  <form id=\"login-form\" action=\"index.php?page=view_leaves\" method=\"post\">
    <legend id=\"login-legend\">Login</legend>
    <label for=\"UserName\">Username:</label>
    <input type=\"TEXT\" name=\"UserName\" size=\"12\" maxlength=\"12\" id=\"UserName\">
    <label for=\"PassWord\">Password:</label>
    <input type=\"password\" name=\"PassWord\" size=\"12\" maxlength=\"12\">
    <input type=\"submit\" class=\"margin-top-twenty\" value=\"Submit\">
  </form>
";
    }

    public function getTemplateName()
    {
        return "index.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,);
    }
}
