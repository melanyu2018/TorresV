<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /home/torres/public_html/TorresV/vendor/maiconpinto/cakephp-adminlte-theme/src/Template/Bake/Element/Controller/add.twig */
class __TwigTemplate_0bc8528bc8b33c1badeeda15da484cdd6a1c8839a40c6d86383044c17bf7fd1c extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa = $this->env->getExtension("WyriHaximus\\TwigView\\Lib\\Twig\\Extension\\Profiler");
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->enter($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "/home/torres/public_html/TorresV/vendor/maiconpinto/cakephp-adminlte-theme/src/Template/Bake/Element/Controller/add.twig"));

        // line 16
        $context["compact"] = [0 => (("'" . ($context["singularName"] ?? null)) . "'")];
        // line 17
        echo "
    /**
     * Add method
     *
     * @return \\Cake\\Http\\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        \$";
        // line 25
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo " = \$this->";
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->newEntity();
        if (\$this->request->is('post')) {
            \$";
        // line 27
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo " = \$this->";
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->patchEntity(\$";
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo ", \$this->request->getData());
            if (\$this->";
        // line 28
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->save(\$";
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo ")) {
                \$this->Flash->success(__('The {0} has been saved.', '";
        // line 29
        echo twig_escape_filter($this->env, ($context["singularHumanName"] ?? null), "html", null, true);
        echo "'));

                return \$this->redirect(['action' => 'index']);
            }
            \$this->Flash->error(__('The {0} could not be saved. Please, try again.', '";
        // line 33
        echo twig_escape_filter($this->env, ($context["singularHumanName"] ?? null), "html", null, true);
        echo "'));
        }
";
        // line 35
        $context["associations"] = $this->getAttribute(($context["Bake"] ?? null), "aliasExtractor", [0 => ($context["modelObj"] ?? null), 1 => "BelongsTo"], "method");
        // line 36
        $context["associations"] = twig_array_merge(($context["associations"] ?? null), $this->getAttribute(($context["Bake"] ?? null), "aliasExtractor", [0 => ($context["modelObj"] ?? null), 1 => "BelongsToMany"], "method"));
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["associations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["assoc"]) {
            // line 39
            $context["otherName"] = $this->getAttribute(($context["Bake"] ?? null), "getAssociatedTableAlias", [0 => ($context["modelObj"] ?? null), 1 => $context["assoc"]], "method");
            // line 40
            $context["otherPlural"] = Cake\Utility\Inflector::variable(($context["otherName"] ?? null));
            // line 41
            echo "        \$";
            echo twig_escape_filter($this->env, ($context["otherPlural"] ?? null), "html", null, true);
            echo " = \$this->";
            echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
            echo "->";
            echo twig_escape_filter($this->env, ($context["otherName"] ?? null), "html", null, true);
            echo "->find('list', ['limit' => 200]);";
            // line 42
            echo "
";
            // line 43
            $context["compact"] = twig_array_merge(($context["compact"] ?? null), [0 => (("'" . ($context["otherPlural"] ?? null)) . "'")]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['assoc'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "        \$this->set(compact(";
        echo twig_join_filter(($context["compact"] ?? null), ", ");
        echo "));
    }
";
        
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->leave($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof);

    }

    public function getTemplateName()
    {
        return "/home/torres/public_html/TorresV/vendor/maiconpinto/cakephp-adminlte-theme/src/Template/Bake/Element/Controller/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 45,  101 => 43,  98 => 42,  90 => 41,  88 => 40,  86 => 39,  82 => 38,  80 => 36,  78 => 35,  73 => 33,  66 => 29,  60 => 28,  52 => 27,  45 => 25,  35 => 17,  33 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
{% set compact = [\"'#{singularName}'\"] %}

    /**
     * Add method
     *
     * @return \\Cake\\Http\\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        \${{ singularName }} = \$this->{{ currentModelName }}->newEntity();
        if (\$this->request->is('post')) {
            \${{ singularName }} = \$this->{{ currentModelName }}->patchEntity(\${{ singularName }}, \$this->request->getData());
            if (\$this->{{ currentModelName }}->save(\${{ singularName }})) {
                \$this->Flash->success(__('The {0} has been saved.', '{{ singularHumanName }}'));

                return \$this->redirect(['action' => 'index']);
            }
            \$this->Flash->error(__('The {0} could not be saved. Please, try again.', '{{ singularHumanName }}'));
        }
{% set associations = Bake.aliasExtractor(modelObj, 'BelongsTo') %}
{% set associations = associations|merge(Bake.aliasExtractor(modelObj, 'BelongsToMany')) %}

{%- for assoc in associations %}
    {%- set otherName = Bake.getAssociatedTableAlias(modelObj, assoc) %}
    {%- set otherPlural = otherName|variable %}
        \${{ otherPlural }} = \$this->{{ currentModelName }}->{{ otherName }}->find('list', ['limit' => 200]);
        {{- \"\\n\" }}
    {%- set compact = compact|merge([\"'#{otherPlural}'\"]) %}
{% endfor %}
        \$this->set(compact({{ compact|join(', ')|raw }}));
    }
", "/home/torres/public_html/TorresV/vendor/maiconpinto/cakephp-adminlte-theme/src/Template/Bake/Element/Controller/add.twig", "/home/torres/public_html/TorresV/vendor/maiconpinto/cakephp-adminlte-theme/src/Template/Bake/Element/Controller/add.twig");
    }
}
