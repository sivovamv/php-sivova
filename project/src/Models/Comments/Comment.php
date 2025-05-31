<?php 

namespace src\Models\Comments;
use src\Models\ActiveRecordEntity;
use src\Models\Users\User;

class Comment extends ActiveRecordEntity
{
    protected $text;        // текст комментария
    protected $authorId;    // ID автора комментария
    protected $articleId;   // ID статьи, к которой относится комментарий


    public function getText(): string{
        return $this->text;
    }

    public function getArticleId(): int {
        return $this->articleId;
    }

    public function getAuthorId(): User{
        return User::getById($this->authorId);
    }


    public function setText(string $text): void{
        if (empty($text)) {
            throw new \Exception('Текст комментария не может быть пустым');
        }
        $this->text = htmlspecialchars($text);
    }

    public function setAuthorId(int $authorId): void{
        $this->authorId = $authorId;
    }

    public function setArticleId(int $articleId): void{
        $this->articleId = $articleId;
    }

    public static function findByArticleId(int $articleId): array
    {
        $db = \src\Services\Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE article_id = :article_id';
        return $db->query($sql, [':article_id' => $articleId], static::class);
    }

    protected static function getTableName(): string{
        return 'comments';
    }

    public static function create(string $text, int $authorId, int $articleId): self
    {
        $comment = new self();
        $comment->setText($text);
        $comment->setAuthorId($authorId);
        $comment->setArticleId($articleId);
        return $comment;
    }
}