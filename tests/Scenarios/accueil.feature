Feature: Accueil des clients
  Scenario: Lorsqu'un groupe arrive, il est placé à une table
    When un groupe de 3 personnes rentre dans le restaurant
    Then le groupe de 3 est placé à la table B
