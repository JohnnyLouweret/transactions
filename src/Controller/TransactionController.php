<?php

namespace App\Controller;

use App\Object\Enum\SourceEnum;
use App\Provider\TransactionProviderFactory;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    /**
     * @var TransactionProviderFactory
     */
    private $transactionProviderFactory;

    /**
     * @param TransactionProviderFactory $transactionProviderFactory
     */
    public function __construct(
        TransactionProviderFactory $transactionProviderFactory
    ) {
        $this->transactionProviderFactory = $transactionProviderFactory;
    }

    /**
     * @Route("/transactions", name="transaction")
     * @throws Exception
     */
    public function all(Request $request): JsonResponse
    {
        $source = $request->query->get('source');

        if (false === SourceEnum::isValidOption($source)) {
            return new JsonResponse('A valid Source must be provided.', 400);
        }

        $transactionProvider = $this->transactionProviderFactory
            ->createTransactionProviderFromSource(new SourceEnum($source));

        return $this->json($transactionProvider->getAll()->toArray());
    }
}
