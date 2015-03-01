# @hint We stick with the Ubiquitous language set in UBIQUITOUS_LANGUAGE_DICTIONARY.md
Feature: Testing Machine notifies a Biologic Test has been launched
    Implying consumable has been consumed
    In order to spend more time focusing on my research rather than on logistic
    As a Biologist
    I want to automate consumable deliveries

    Scenario: Successfully notify 1 Supplier to replenish stocks following a Biologic Test with 10 Test Tube
        # @hint Given steps are in Present Continuous (ing)
        Given a Testing Machine named "PCR"
        And the Testing Machine named "PCR" consuming 22µl of "Platinum Blue Supermix" per Test Tube
        And the laboratory already having 40220µl of "Platinum Blue Supermix" in stock
        And the laboratory always needing at least 40ml of "Platinum Blue Supermix"
        And a Supplier "Invitrogen" providing "Platinum Blue Supermix"
        # @hint When/Then steps are in Present
        When a "Genotyping Test" is launched with 10 Test Tubes
        Then the Supplier "Invitrogen" should be contacted to replenish "Platinum Blue Supermix" stocks

    Scenario: Successfully receive Biologic Test notification but don't contact Supplier to replenish stocks
        # @hint Given steps are in Present Continuous (ing)
        Given a Testing Machine named "PCR"
        And the Testing Machine named "PCR" consuming 22µl of "Platinum Blue Supermix" per Test Tube
        And the laboratory already having 40023µl of "Platinum Blue Supermix" in stock
        And the laboratory always needing at least 40ml of "Platinum Blue Supermix"
        And a Supplier "Invitrogen" providing "Platinum Blue Supermix"
        # @hint When/Then steps are in Present
        When someone launches a "Genotyping Test" with 1 Test Tube
        Then the Supplier "Invitrogen" should not be contacted to replenish "Platinum Blue Supermix" stocks
