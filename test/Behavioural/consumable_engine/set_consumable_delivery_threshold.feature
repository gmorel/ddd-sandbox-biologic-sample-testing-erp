Feature: Biologist sets whenever a Consumable reaches delivery threshold
    Implying Supplier will be contacted to prepare a new Consumable delivery
    In order to spend more time focusing on my research rather than on logistic
    As a Biologist
    I want to set a relevant consumable deliveries threshold

    Scenario: Successfully set consumable threshold
        Given a Testing Machine named "PCR"
        And the Testing Machine named "PCR" consuming 22µl of "Platinum Blue Supermix" per test tube
        And a supplier "Invitrogen" providing "Platinum Blue Supermix"
        When a biologist sets "Platinum Blue Supermix" delivery threshold at 40ml
        Then the supplier "Invitrogen" is set to replenish laboratory "Platinum Blue Supermix" stocks when bellow 40ml
