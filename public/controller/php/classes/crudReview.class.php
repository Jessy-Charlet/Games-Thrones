<?php
class crudReview
{
    private $product_id;
    private $customer_id;
    private $text;
    private $rating;

    public function setProductId($newPoduct_id)
    {
        $this->product_id = $newPoduct_id;
    }

    public function setCustomerId($newCustomer_id)
    {
        $this->customer_id = $newCustomer_id;
    }

    public function setText($newText)
    {
        $this->text = $newText;
    }

    public function setRating($newRating)
    {
        $this->rating = $newRating;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getRating()
    {
        return $this->rating;
    }


    public function createReview($conn, $productId, $customerId, $text, $rating)
    {
        $sql = $conn->prepare("INSERT INTO review (product_id, customer_id, text, rating) VALUES (:product_id, :customer_id, :text, :rating)");
        $sql->execute(
            array(
                ':product_id' => $productId,
                ':customer_id' => $customerId,
                ':text' => $text,
                ':rating' => $rating
            )
        );
    }

    public function readReview($conn, $productId, $customerId)
    {
        $sql = $conn->prepare("SELECT * FROM review WHERE product_id = :product_id AND customer_id = :customer_id");
        $sql->execute(
            array(
                ':product_id' => $productId,
                ':customer_id' => $customerId,
            )
        );
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->setProductId($result['product_id']);
            $this->setCustomerId($result['cusromer_id']);
            $this->setText($result['rating']);
            return true;
        } else {
            return false;
        }
    }

    public function updateReview($conn, $productId, $customerId, $text, $rating)
    {
        $sql = $conn->prepare("UPDATE rewiew SET text = :text, rating = :rating WHERE product_id = :product_id AND customer_id = :customer_id");
        $sql->execute(
            array(
                ':text' => $text,
                ':rating' => $rating,
                ':product_id' => $productId,
                ':customer_id' => $customerId
            )
        );
    }

    public function deleteReview($conn, $productId, $customerId)
    {
        $sql = $conn->prepare("DELETE FROM review WHERE product_id = :product_id AND customer_id = :customer_id");
        $sql->execute(
            array(
                ':product_id' => $productId,
                ':custimer_id' => $customerId
            )
        );
    }

    public function getReviewsByProductId($conn, $productId)
    {
        $sql = $conn->prepare("SELECT * FROM review WHERE product_id = :product_id");
        $sql->execute(array(':product_id' => $productId));
        $reviews = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $review = new Review();
            $review->setProductId($row['product_id']);
            $review->setCustomerId($row['customer_id']);
            $review->setText($row['text']);
            $review->setRating($row['rating']);
            $reviews[] = $review;
        }
        return $reviews;
    }
}


