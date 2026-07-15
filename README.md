# Gator-Gate-Editor for bbPress
Experimental modular enhancement for the bbPress Visual Editor (TinyMCE), featuring responsive media handling, typography controls, custom embed processing, content formatting, and security tools for a richer forum editing experience.

The project focuses on improving usability, media handling, typography, content formatting, and editor consistency without requiring users to work directly with HTML. It also explores new approaches to content security by validating and transforming editor data before it reaches the forum database.

> **Status:** Alpha (Work in Progress)

## Current Features

* Full TinyMCE editor enabled for bbPress.
* Advanced TinyMCE toolbar with additional formatting tools.
* Re-enable Font family and font size selection.
* Custom editor styling and content canvas.
* Media dialog guidance and input restrictions.
* Automatic bidirectional iframe ↔ WordPress [embed] placeholder conversion for safer database storage.
* Video URL validation and embed processing.
* Responsive video alignment system.
* Image source validation and filtering.
* Safe frontend alignment rendering.
* Typography preservation across bbPress content.
* Font family support through frontend filters.
* Inline style normalization.
* Debug mode for exposing native WordPress editor tabs.
* Modular architecture designed for future expansion.

## Project Goals

* Improve the bbPress writing experience.
* Keep forum content responsive and consistent.
* Reduce opportunities for malformed or unsafe embedded content.
* Build a lightweight, modular editor that can evolve independently of bbPress core.
* Serve as a foundation for future Gator-Gate modules.

## Installation & Testing

* This project is currently distributed as standalone PHP code snippets.
* **Test all snippets in a sandbox or staging environment first.
  Exercise caution when installing or removing snippets.
  Database effects and site behaviour may vary depending on your configuration.**
* Always back up your website and database before installing or modifying snippets.
* The easiest installation method is to copy and paste the snippets
  into a WordPress code snippet manager, such as **Fluent Snippets**.



## License

Licensed under **GPL v2 or later**.

AI-generated and AI-assisted code is provided **AS IS** without warranty. Users are responsible for testing and validating the code before deploying it in production environments.


## ☕ Voluntary Support
tinfoilwho.com
