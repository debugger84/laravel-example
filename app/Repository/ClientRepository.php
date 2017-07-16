<?php

namespace App\Repository;

use App\Entity\Client;
use App\Repository\Filter\ClientFilter;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ClientRepository extends EntityRepository
{
    /**
     * @param ClientFilter $filter
     * @return Client|null
     */
    public function findOneClient(ClientFilter $filter)
    {
        $query = $this->createQuery($filter);

        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * @param ClientFilter $filter
     * @return Client[]|Collection
     */
    public function findAllClients(ClientFilter $filter)
    {
        $query = $this->createQuery($filter);

        $query->orderBy('client.surname');

        return $query->getQuery()->getResult();
    }

    public function saveClient(Client $client)
    {
        $parameters = $client->copyToArray();

        if ($client->getId()) {
            $sql = 'SELECT site.update_client(:id, :name, :surname, :code, :email, :address, :city, :country)';
        } else {
            $sql = 'SELECT site.create_client(:id, :name, :surname, :code, :email, :address, :city, :country)';
            $parameters['id'] = $this->getClientSequenceVal();
        }

        $this->executeNativeQuery($sql, $parameters);
    }

    public function deleteClient(Client $client)
    {
        if (!$client->getId()) {
            throw new \RuntimeException('Client id is empty');
        }
        $sql = 'SELECT site.delete_client(:id)';
        $parameters = ['id' => $client->getId()];

        $this->executeNativeQuery($sql, $parameters);
    }

    private function executeNativeQuery($sql, $parameters)
    {
        $em = $this->getEntityManager();
        $qb = $em->createNativeQuery(
            $sql,
            new ResultSetMapping()
        );
        $qb->setParameters($parameters);
        $qb->execute();
        $em->flush();
    }

    private function getClientSequenceVal()
    {
        $sql = 'SELECT nextval(\'site.client_id_seq\'::regclass) as id';
        $em = $this->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['id'];
    }

    /**
     * @param ClientFilter $filter
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function createQuery(ClientFilter $filter)
    {
        $qb = $this->createQueryBuilder('client');

        if ($filter->getId()) {
            $qb->andWhere('client.id = :id')
                ->setParameter('id', $filter->getId());
        }


        return $qb;
    }
}