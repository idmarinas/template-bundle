---
title: {{project_name}}
description: Short description for your Symfony Bundle
# Aditional for Docs only
# since: '1.0'
# deprecated:
#   since: '1.5'
#   removed: '2.0'
---

::u-page-hero{orientation="horizontal"}
#headline
:last-release{:as-badge=true}

#title
:text-bundle-name

#description
:vars{n="project.description"}

#default
:svg-logo

#links
  :::u-button
  ---
  color: neutral
  size: xl
  to: /getting-started/installation
  trailing-icon: i-tabler-arrow-right
  ---
  Get started
  :::

:button-star-on-github
::

::u-page-c-t-a{orientation="horizontal" :reverse="true"}
#title
Support Me

#description
  ::note
  **Support me** 🩵 If you like this project, give it a 🌟 and share it with your friends!
  ::

#default
:svg-ship{width="320" height="364" alt="Illustration" class="w-full rounded-lg"}

#links
  :::u-button
  ---
  icon: i-simple-icons-paypal
  to: https://www.paypal.me/idmarinas
  target: _blank
  ---
  Help My Projects
  :::

  :::u-button
  ---
  icon: i-simple-icons-github
  color: purple
  to: https://github.com/sponsors/idmarinas
  target: _blank
  ---
  Sponsor
  :::
::

::u-page-section
#title
A short summary of what **:text-bundle-name** includes and how it can be used in your project.

#features
  :::u-page-feature
  ---
  icon: i-tabler-settings
  target: _blank
  to: https://www.github.com/idmarinas/template-bundle
  ---
  #title
  Built your bundle with [:vars{n="project"}]{.text-primary}

  #description
  Create your Symfony Bundle with this Template
  :::
::
