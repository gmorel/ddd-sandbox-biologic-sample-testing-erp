# @hint We stick with the Ubiquitous language set in UBIQUITOUS_LANGUAGE_DICTIONARY.md
Feature: Biologist sets whenever a Consumable reaches delivery threshold
    Implying Supplier will be contacted to prepare a new Consumable delivery
    In order to spend more time focusing on my research rather than on logistic
    As a Biologist
    I want to set a relevant consumable deliveries threshold

    Scenario: Successfully set consumable threshold
        # @hint Given steps are in Present Continuous (ing)
        Given a Testing Machine named "PCR"
        And the Testing Machine named "PCR" consuming 22µl of "Platinum Blue Supermix" per Test Tube
        And a Supplier "Invitrogen" providing "Platinum Blue Supermix"
        # @hint When/Then steps are in Present
        When I set "Platinum Blue Supermix" delivery threshold at 40ml
        Then the Supplier "Invitrogen" is set to replenish laboratory "Platinum Blue Supermix" stocks when bellow 40ml
