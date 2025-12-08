<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* registration/register.html.twig */
class __TwigTemplate_8cabf8b13e77f871448257091a10c009 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Inscription";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    ";
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 6, $this->source); })()), 'form_start', ["attr" => ["class" => "form-signin"]]);
        yield "
        ";
        // line 7
        if ((($tmp = $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 7, $this->source); })()), 'errors')) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 8
            yield "            <div class=\"alert alert-danger\">";
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 8, $this->source); })()), 'errors');
            yield "</div>
        ";
        }
        // line 10
        yield "
        <div class=\"card p-3 mb-4 objectifs-card\" style=\"max-width: 500px; margin: 0 auto;\">
            <h1 class=\"h3 mb-3 font-weight-normal text-white\">Inscription</h1>
            
            <div class=\"form-group\">
                ";
        // line 15
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 15, $this->source); })()), "name", [], "any", false, false, false, 15), 'label', ["label" => "Nom complet"]);
        yield "
                ";
        // line 16
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 16, $this->source); })()), "name", [], "any", false, false, false, 16), 'widget', ["attr" => ["class" => "form-control", "autofocus" => "autofocus", "required" => "required"]]);
        // line 22
        yield "
            </div>

            <div class=\"form-group\">
                ";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 26, $this->source); })()), "email", [], "any", false, false, false, 26), 'label', ["label" => "Email"]);
        yield "
                ";
        // line 27
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 27, $this->source); })()), "email", [], "any", false, false, false, 27), 'widget', ["attr" => ["class" => "form-control", "required" => "required"]]);
        // line 32
        yield "
            </div>

            <div class=\"form-group\">
                ";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 36, $this->source); })()), "taille", [], "any", false, false, false, 36), 'label', ["label" => "Taille (cm)"]);
        yield "
                ";
        // line 37
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 37, $this->source); })()), "taille", [], "any", false, false, false, 37), 'widget', ["attr" => ["class" => "form-control", "required" => "required", "min" => 100, "max" => 250]]);
        // line 44
        yield "
            </div>

            <div class=\"form-group\">
                ";
        // line 48
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 48, $this->source); })()), "poids", [], "any", false, false, false, 48), 'label', ["label" => "Poids (kg)"]);
        yield "
                ";
        // line 49
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 49, $this->source); })()), "poids", [], "any", false, false, false, 49), 'widget', ["attr" => ["class" => "form-control", "required" => "required", "min" => 30, "max" => 300, "step" => "0.1"]]);
        // line 57
        yield "
            </div>

            <div class=\"form-group\">
                ";
        // line 61
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 61, $this->source); })()), "plainPassword", [], "any", false, false, false, 61), 'label', ["label" => "Mot de passe"]);
        yield "
                ";
        // line 62
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 62, $this->source); })()), "plainPassword", [], "any", false, false, false, 62), 'widget', ["attr" => ["class" => "form-control", "required" => "required"]]);
        // line 67
        yield "
            </div>

<div class=\"d-flex gap-2\">
                <button class=\"btn btn-primary flex-grow-1\" type=\"submit\">
                    S'inscrire
                </button>
                <a href=\"";
        // line 74
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"btn btn-secondary flex-grow-1\">
                    J'ai déjà un compte
                </a>
            </div>
        </div>
    ";
        // line 79
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 79, $this->source); })()), 'form_end');
        yield "
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "registration/register.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  191 => 79,  183 => 74,  174 => 67,  172 => 62,  168 => 61,  162 => 57,  160 => 49,  156 => 48,  150 => 44,  148 => 37,  144 => 36,  138 => 32,  136 => 27,  132 => 26,  126 => 22,  124 => 16,  120 => 15,  113 => 10,  107 => 8,  105 => 7,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Inscription{% endblock %}

{% block body %}
    {{ form_start(registrationForm, {'attr': {'class': 'form-signin'}}) }}
        {% if form_errors(registrationForm) %}
            <div class=\"alert alert-danger\">{{ form_errors(registrationForm) }}</div>
        {% endif %}

        <div class=\"card p-3 mb-4 objectifs-card\" style=\"max-width: 500px; margin: 0 auto;\">
            <h1 class=\"h3 mb-3 font-weight-normal text-white\">Inscription</h1>
            
            <div class=\"form-group\">
                {{ form_label(registrationForm.name, 'Nom complet') }}
                {{ form_widget(registrationForm.name, {
                    'attr': {
                        'class': 'form-control',
                        'autofocus': 'autofocus',
                        'required': 'required'
                    }
                }) }}
            </div>

            <div class=\"form-group\">
                {{ form_label(registrationForm.email, 'Email') }}
                {{ form_widget(registrationForm.email, {
                    'attr': {
                        'class': 'form-control',
                        'required': 'required'
                    }
                }) }}
            </div>

            <div class=\"form-group\">
                {{ form_label(registrationForm.taille, 'Taille (cm)') }}
                {{ form_widget(registrationForm.taille, {
                    'attr': {
                        'class': 'form-control',
                        'required': 'required',
                        'min': 100,
                        'max': 250
                    }
                }) }}
            </div>

            <div class=\"form-group\">
                {{ form_label(registrationForm.poids, 'Poids (kg)') }}
                {{ form_widget(registrationForm.poids, {
                    'attr': {
                        'class': 'form-control',
                        'required': 'required',
                        'min': 30,
                        'max': 300,
                        'step': '0.1'
                    }
                }) }}
            </div>

            <div class=\"form-group\">
                {{ form_label(registrationForm.plainPassword, 'Mot de passe') }}
                {{ form_widget(registrationForm.plainPassword, {
                    'attr': {
                        'class': 'form-control',
                        'required': 'required'
                    }
                }) }}
            </div>

<div class=\"d-flex gap-2\">
                <button class=\"btn btn-primary flex-grow-1\" type=\"submit\">
                    S'inscrire
                </button>
                <a href=\"{{ path('app_login') }}\" class=\"btn btn-secondary flex-grow-1\">
                    J'ai déjà un compte
                </a>
            </div>
        </div>
    {{ form_end(registrationForm) }}
{% endblock %}
", "registration/register.html.twig", "/var/www/html/templates/registration/register.html.twig");
    }
}
