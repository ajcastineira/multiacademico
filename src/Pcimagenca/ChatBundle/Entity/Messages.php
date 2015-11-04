<?php
namespace Pcimagenca\ChatBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="ChatMessages")
 */
class Messages
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var AuthorInterface
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    private $author;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $channel;
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $message;
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $insertDate;
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * @param AuthorInterface $author
     */
    public function setAuthor(AuthorInterface $author)
    {
        $this->author = $author;
    }
    /**
     * @param string $content
     */
    public function setMessage($content)
    {
        $this->message = $content;
    }
    /**
     * @param string $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }
    /**
     * @param \DateTime $insertDate
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;
    }
    /**
     * @return \DateTime
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }
    /**
     * @return AuthorInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }
}