<?php

/**
 * Description of FormGeneratorCommand
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
namespace Multiservices\ArxisBundle\Command;
 
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand;
//use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineFormGenerator;
use Symfony\Component\HttpKernel\Bundle\BundleInterface; 
class FormGeneratorCommand extends GenerateDoctrineCrudCommand
{
    protected $generator;
    protected $formGenerator;
 
    protected function configure()
    {
        parent::configure();
        $this->setName('arxis:generate:crud');
        $this->setDescription('Our admin generator rocks!');
    }
 
    protected function getGenerator(BundleInterface $bundle = null)
    {
        if (null === $this->generator) {
            $this->generator = $this->createGenerator();
            //$skeletonDirs=$this->getSkeletonDirs($bundle);
            $bundle->getName();
            $skeletonDirs[]=__DIR__.'/../Resources/SensioGeneratorBundle/skeleton';
            $this->generator->setSkeletonDirs($skeletonDirs);
            //$this->generator = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/SensioGeneratorBundle/skeleton/crud');
        }
        return $this->generator;
    }
    
     protected function getFormGenerator($bundle = null)
    {
        if (null === $this->formGenerator) {
            $skeletonDirs[]=__DIR__.'/../Resources/SensioGeneratorBundle/skeleton';
            $this->formGenerator = new DoctrineFormGenerator($this->getContainer()->get('filesystem'));
            $this->formGenerator->setSkeletonDirs($skeletonDirs);
        }

        return $this->formGenerator;
    }
}