<?php

namespace MultiacademicoBundle\Form\DataTransformer;

/**
 * Description of DataToConfigDataTransformer
 *
 * @author Rene Arias <renearias@arxis.la>
 */
use MultiacademicoBundle\Configuracion\ConfiguracionEntidad;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use JMS\Serializer\SerializerBuilder;

class DataToConfigDataTransformer implements DataTransformerInterface
{
    private $serializer;

    public function __construct($class)
    {
        $this->serializer = SerializerBuilder::create()->build();
        $this->class=$class;
    }
    
    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  json_array|null $data
     * @return Object
     */
    public function transform($data)
    {   
        if (null === $data) {
            return new $this->class();
        }
        $configData = $this->serializer->deserialize(json_encode($data), $this->class,'json');
        return $configData;
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $configData
     * @return ConfiguracionEntidad|null
     * @throws TransformationFailedException if object (configData) is not found.
     */
    public function reverseTransform($configData)
    {
        // no data json? It's optional, so that's ok
        if (!$configData) {
            return ;
        }
        $data = json_decode($this->serializer->serialize($configData, 'json'));
        if (null === $data) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'Invalid JSON',
                $configData
            ));
        }

        return $data;
    }
}
