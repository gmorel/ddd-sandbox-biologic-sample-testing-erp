# @hint We stick with the Ubiquitous language set in UBIQUITOUS_LANGUAGE_DICTIONARY.md
Feature: Testing Machine notifies a Biologic Test has been launched
    # @hint Implying CONTEXT (if useful)
    Implying consumable has been consumed
    # @hint In order to GOAL
    In order to spend more time focusing on my research rather than on logistic
    # @hint As a ACTOR
    As a Biologist
    # @hint I want to ACTION
    I want to automate consumable deliveries

    Scenario: Successfully notify 1 Supplier to replenish stocks following a Biologic Test with 10 test tube
        # @hint Given steps are in Present Continuous (ing)
        Given a Testing Machine named "PCR"
        And the Testing Machine named "PCR" consuming 22µl of "Platinum Blue Supermix" per test tube
        And the laboratory already having 40220µl of "Platinum Blue Supermix" in stock
        And the laboratory always needing at least 40ml of "Platinum Blue Supermix"
        And a supplier "Invitrogen" providing "Platinum Blue Supermix"
        # @hint When/Then steps are in Present
        When a "Genotyping Test" is launched with 10 test tubes
        Then the supplier "Invitrogen" should be contacted to replenish "Platinum Blue Supermix" stocks

    Scenario: Successfully receive Biologic Test notification but don't contact Supplier to replenish stocks
        # @hint Given steps are in Present Continuous (ing)
        Given a Testing Machine named "PCR"
        And the Testing Machine named "PCR" consuming 22µl of "Platinum Blue Supermix" per test tube
        And the laboratory already having 40023µl of "Platinum Blue Supermix" in stock
        And the laboratory always needing at least 40ml of "Platinum Blue Supermix"
        And a supplier "Invitrogen" providing "Platinum Blue Supermix"
        # @hint When/Then steps are in Present
        When a biologist launches a "Genotyping Test" with 1 test tube
        Then the supplier "Invitrogen" should not be contacted to replenish "Platinum Blue Supermix" stocks
