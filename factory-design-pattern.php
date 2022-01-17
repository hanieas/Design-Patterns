<?php

interface IFoodSupplier
{
    public function accept(): void;

    public function cook(): void;

    public function deliver(): void;
}

abstract class FoodCompany
{
    abstract public function getFood(): IFoodSupplier;

    abstract public function getMenu(): void;

    public function order()
    {
        $food = $this->getFood();
        $food->accept();
        echo "\n";
        $food->cook();
        echo "\n";
        $food->deliver();
    }
}

class PizzaFactory extends FoodCompany
{
    public function getFood(): IFoodSupplier
    {
        return new PizzaCreator();
    }

    public function getMenu(): void
    {
        echo "Neapolitan Pizza\n";
        echo "Chicago Pizza\n";
        echo "Greek Pizza\n";
    }
}

class PastaFactory extends FoodCompany
{
    public function getFood(): IFoodSupplier
    {
        return new PastaCreator();
    }

    public function getMenu(): void
    {
        echo "Spaghetti\n";
        echo "Penne\n";
        echo "Rigatoni\n";
    }
}

class PizzaCreator implements IFoodSupplier
{
    public function accept(): void
    {
        echo 'The Pizza Accepted';
    }

    public function cook(): void
    {
        echo 'The Pizza Cooked';
    }

    public function deliver(): void
    {
        echo 'The Pizza Deliveried';
    }
}

class PastaCreator implements IFoodSupplier
{
    public function accept(): void
    {
        echo 'The Pasta Accepted';
    }

    public function cook(): void
    {
        echo 'The Pasta Cooked';
    }

    public function deliver(): void
    {
        echo 'The Pasta Deliveried';
    }
}

function getClientOrder(FoodCompany $factory)
{
    echo "Get The Menu:\n";
    $factory->getMenu();
    echo "Order:\n";
    $factory->order();
}

echo "Testing Order a Pizza:\n";
getClientOrder(new PizzaFactory());
echo "\n\n";


echo "Testing Order a Pasta:\n";
getClientOrder(new PastaFactory());
echo "\n\n";
