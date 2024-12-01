<?php

declare(strict_types=1);

namespace App\Database;

use App\Models\Contact;

class ContactDAO
{

    private \PDO $database;

    public function __construct()
    {
        $this->database = ConnectionFactory::getConnection();
    }

    public function list(): array
    {
        $list = [];
        try {
            $query = "SELECT id, name, phone, photo FROM contacts ORDER BY id DESC LIMIT 20";
            $statement = $this->database->prepare($query);
            $statement->execute();            
            while($row = $statement->fetch(\PDO::FETCH_OBJ)) {
                $contact = new Contact();
                $contact->setId($row->id);
                $contact->setName($row->name);
                $contact->setPhone($row->phone);                
                $contact->setPhoto($row->photo);
                array_push($list, $contact);
            }
        } 
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return $list;
    }

    public function show(int $id): ?Contact
    {
        $contact = new Contact();
        try {
            $query = "SELECT * FROM contacts WHERE id = :id";
            $statement = $this->database->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();            
            if($statement->rowCount() > 0) {                
                $row = $statement->fetch(\PDO::FETCH_OBJ);
                $contact->setId($row->id);
                $contact->setName($row->name);
                $contact->setPhone($row->phone);
                $contact->setEmail($row->email);
                $contact->setAnnotations($row->annotations);
                $contact->setPhoto($row->photo);
            }
            else {
                $contact = null;
            }
        } 
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return $contact;
    }
    
    public function store(Contact $contact): bool
    {
        try {
            if(self::checkIfEmailExists($contact->getEmail())) {
                return false;
            }
            else {
                $query = "INSERT INTO contacts (name, phone, email, annotations, photo) 
                   VALUES (:name, :phone, :email, :annotations, :photo)";
                $statement = $this->database->prepare($query);
                $statement->bindValue(":name", $contact->getName());
                $statement->bindValue(":phone", $contact->getPhone());
                $statement->bindValue(":email", $contact->getEmail());
                $statement->bindValue(":annotations", $contact->getAnnotations());
                $statement->bindValue(":photo", $contact->getPhoto());
                $statement->execute();            
                if($statement->rowCount() > 0) {
                    return true;
                }
            }            
        } 
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return false;

    }

    public function update(Contact $contact): bool
    {
        
        $email = $contact->getEmail();
        if(self::checkIfEmailExists($email)) {
            if($email !== self::getEmailById($contact->getId())) {
                return false;
            }
        }
        try {
            $query = "UPDATE contacts SET name = :name, phone = :phone, email = :email, 
                annotations = :annotations, photo = :photo WHERE id = :id";
            $statement = $this->database->prepare($query);
            $statement->bindValue(":name", $contact->getName());
            $statement->bindValue(":phone", $contact->getPhone());
            $statement->bindValue(":email", $contact->getEmail());
            $statement->bindValue(":annotations", $contact->getAnnotations());
            $statement->bindValue(":photo", $contact->getPhoto());
            $statement->bindValue(":id", $contact->getId());
            $statement->execute();
            return true;            
        } 
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return false;

    }

    public function search(string $name): array
    {
        $list = [];
        try {
            $query = "SELECT id, name, phone, photo FROM contacts WHERE name LIKE :name";
            $statement = $this->database->prepare($query);
            $statement->bindValue(":name", "%".$name."%");
            $statement->execute();
            while($row = $statement->fetch(\PDO::FETCH_OBJ)) {
                $contact = new Contact();
                $contact->setId($row->id);
                $contact->setName($row->name);
                $contact->setPhone($row->phone);
                $contact->setPhoto($row->photo);
                array_push($list, $contact);
            }
        }
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return $list;
    }

    public function destroy(int $id): bool
    {
        try {
            $query = "DELETE FROM contacts WHERE id = :id";
            $statement = $this->database->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            if($statement->rowCount() > 0) {
                return true;
            }            
        } 
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return false;
    }

    public function getPhoto(int $id): string
    {
        try {
            $query = "SELECT photo FROM contacts WHERE id = :id";
            $statement = $this->database->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            if($statement->rowCount() > 0) {
                $row = $statement->fetch(\PDO::FETCH_OBJ);
                return $row->photo;
            }
        } 
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return "";
    }

    public function getEmailById(int $id): ?string
    {
        try {
            $query = "SELECT email FROM contacts WHERE id = :id";
            $statement = $this->database->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            if($statement->rowCount() > 0) {
                $row = $statement->fetch(\PDO::FETCH_OBJ);
                return $row->email;
            }
        } 
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return null;
    }

    public function checkIfEmailExists(string $email): bool
    {
        try {
            $query = "SELECT email FROM contacts WHERE email = :email";
            $statement = $this->database->prepare($query);
            $statement->bindValue(":email", $email);
            $statement->execute();
            if($statement->rowCount() > 0) {
                return true;
            }
        } 
        catch (\PDOException $exception) {
            $exception->getMessage();
        }
        return false;
    }

}