<?php

namespace Moonspot\MaterialComponents;

use Moonspot\Component\ComponentAbstract;

/**
 * Materialize footer component.
 *
 * Renders a responsive page footer with configurable sections and copyright
 * block following the Materialize guidelines.
 */
class Footer extends ComponentAbstract {

    // attributes
    /**
     * ARIA role applied to the footer element.
     */
    public string $role = 'contentinfo';

    // settings
    /**
     * Ensures the footer has the Materialize `page-footer` styling.
     */
    protected string $wrapper_class = 'page-footer';

    /**
     * Container class for the sections area.
     */
    protected string $container_class = 'container';

    /**
     * Row class wrapping the column sections.
     */
    protected string $section_row_class = 'row';

    /**
     * Section definitions for the upper content area.
     *
     * Each section accepts:
     *  - title (string)
     *  - title_class (string)
     *  - content (string|\Closure)
     *  - content_class (string)
     *  - column_class (string)
     *  - links (array)
     *  - links_class (string)
     *
     * @var array<int, array<string, mixed>>
     */
    protected array $sections = [];

    /**
     * Copyright text rendered in the lower bar.
     */
    protected string $copyright = '';

    /**
     * Additional block rendered on the right inside the copyright bar.
     *
     * @var array<int|string, array<string, mixed>|string>
     */
    protected array $right_links = [];

    /**
     * Wrapper class for the copyright bar.
     */
    protected string $copyright_wrapper_class = 'footer-copyright';

    /**
     * Container class inside the copyright wrapper.
     */
    protected string $copyright_container_class = 'container';

    /**
     * {@inheritDoc}
     */
    public function setDefaults(): void {
        if (empty($this->role)) {
            $this->role = 'contentinfo';
        }

        if (!str_contains($this->class, 'page-footer')) {
            $this->class = trim(($this->wrapper_class ?: 'page-footer') . ' ' . $this->class);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function markup(): void {
        ?>
        <footer <?=$this->attributes()?>>
            <?php $this->renderSections(); ?>
            <?php $this->renderCopyright(); ?>
        </footer>
        <?php
    }

    /**
     * Renders the main sections block when sections are defined.
     */
    protected function renderSections(): void {
        $sections = $this->normalizeSections($this->sections);

        if (empty($sections)) {
            return;
        }
        ?>
        <div class="<?=htmlspecialchars($this->container_class)?>">
            <div class="<?=htmlspecialchars($this->section_row_class)?>">
                <?php foreach ($sections as $section) { ?>
                    <div class="<?=htmlspecialchars($section['column_class'])?>">
                        <?php if ($section['title'] !== '') { ?>
                            <h5 class="<?=htmlspecialchars($section['title_class'])?>"><?=htmlspecialchars($section['title'])?></h5>
                        <?php } ?>
                        <?php if ($section['content'] !== null) { ?>
                            <p class="<?=htmlspecialchars($section['content_class'])?>">
                                <?php
                                if (is_callable($section['content'])) {
                                    call_user_func($section['content']);
                                } else {
                                    echo htmlspecialchars((string)$section['content']);
                                }
                            ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($section['links'])) { ?>
                            <ul>
                                <?php foreach ($section['links'] as $link) { ?>
                                    <li>
                                        <a href="<?=htmlspecialchars($link['href'])?>" class="<?=htmlspecialchars($link['class'])?>"><?=htmlspecialchars($link['label'])?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    /**
     * Renders the copyright bar if there is content or right links.
     */
    protected function renderCopyright(): void {
        $right_links = $this->normalizeLinks($this->right_links);

        if ($this->copyright === '' && empty($right_links)) {
            return;
        }
        ?>
        <div class="<?=htmlspecialchars($this->copyright_wrapper_class)?>">
            <div class="<?=htmlspecialchars($this->copyright_container_class)?>">
                <?=htmlspecialchars($this->copyright)?>
                <?php foreach ($right_links as $link) { ?>
                    <a href="<?=htmlspecialchars($link['href'])?>" class="<?=htmlspecialchars($link['class'])?>"><?=htmlspecialchars($link['label'])?></a>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    /**
     * Normalizes section definitions.
     *
     * @param array<int, array<string, mixed>> $sections
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeSections(array $sections): array {
        $normalized = [];

        foreach ($sections as $section) {
            if (!is_array($section)) {
                continue;
            }

            $links   = $this->normalizeLinks($section['links'] ?? []);
            $content = $section['content'] ?? null;
            if ($content !== null && !is_callable($content)) {
                $content = (string)$content;
            }

            $normalized[] = [
                'title'         => (string)($section['title'] ?? ''),
                'title_class'   => trim((string)($section['title_class'] ?? '')),
                'content'       => $content,
                'content_class' => trim((string)($section['content_class'] ?? '')),
                'links'         => $links,
                'column_class'  => trim((string)($section['column_class'] ?? 'col s12')),
            ];
        }

        return $normalized;
    }

    /**
     * Normalizes link arrays for sections or copyright area.
     *
     * @param array<int|string, array<string, mixed>|string> $links
     *
     * @return array<int, array<string, string>>
     */
    protected function normalizeLinks(array $links): array {
        $normalized = [];

        foreach ($links as $key => $link) {
            if (is_array($link)) {
                $label = (string)($link['label'] ?? $link['text'] ?? '');
                $href  = (string)($link['href'] ?? '#!');
                $class = trim((string)($link['class'] ?? ''));
            } else {
                $label = (string)$link;
                $href  = is_string($key) ? (string)$key : '#!';
                $class = '';
            }

            if ($label === '') {
                continue;
            }

            $normalized[] = [
                'label' => $label,
                'href'  => $href,
                'class' => $class,
            ];
        }

        return $normalized;
    }
}
