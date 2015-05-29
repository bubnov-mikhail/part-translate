<?php
namespace BubnovKelnik\PartTranslate\Twig\Extension;

use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class PartTranslateExtension extends \Twig_Extension
{
    /**
     * translator
     * @var Translator
     */
    protected $translator;

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('partTranslate', [$this, 'onPartTranslateFilter']),
        ];
    }

    /**
     * Finds all %tokens% in string and translates them
     *
     * @param  $string String with markers in format %marker_without_spaces%
     * @return String
     */
    public function onPartTranslateFilter($string = '')
    {
        $parts = [];
        if (!preg_match_all('/%(\S+?)%/', $string, $parts)) {
            return $string;
        }
        $search = [];
        $replace = [];
        foreach ($parts[1] as $p => $part) {
            if($parts[0][$p] == '%'.$this->translator->trans($part).'%')
            {
                continue;
            }
            $search[] = $parts[0][$p];
            $replace[] = $this->translator->trans($part);
        }

        return str_replace($search, $replace, $string);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'parttranslate_extension';
    }

    /**
     * Set translator
     */
    public function setTranslator(Translator $translator)
    {
        $this->translator = $translator;
    }
}
