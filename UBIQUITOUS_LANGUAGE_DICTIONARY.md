# Ubiquitous Language dictionary

@hint Aim is to compile all domain concepts and find their name right at the beginning of the project.
      These names must always be used by `End Users`, `Domain Expert` and `Developers` during the whole project life cycle.
      At the end this shall avoid any misunderstanding between these 3 project actors.
      Doing this at the beginning of the project will force your team to think about clearly naming Domain concepts.
      This will lead you to have a conversation between all project actors leading to some sort of brain storming.
      Consequently you will spare a sensible amount of time in the long term by identifying problems faster and correctly naming things.

## Biologic Sample Testing ERP
This is the sandbox project.
Responsible for automating `Consumable` `Deliveries` consumed by `Testing Machine`.

## Biologists
End users who don't want run out of `Testing Machine` `Consumable`.
They just wish to set a `Delivery Threshold` for each `Consumable`.

## Testing Machine

--------------------------

Units performing a `Biologic Test` against `Test Tubes` and consuming `Consumables` to do so.
They can analise several `Test Tubes` in one `Biologic Test`.
We compute each necessary `Consumable` per `Test Tube` in unit (ml/tube or µl/tube).

Concrete example :
- Flow cytometer (FACS)
- Thermocycler (PCR)
- Electrophoresis

### Objects

#### Raw Test Result
Result issued from a `Biologic Test` by a `Testing Machine` usable directly by an `ERP` platform.

#### Actionable Test Result
Compiled `Raw Test Result` ready to be used by Biologist.

#### Biologic Test
Process analysing one or more `Test Tubes` and producing a `Raw Test Result` for each `Test Tubes` automated by a `Testing Machine`.
Implies a sample contained into a `Test Tube` to be analyzed.
And `Consumable` to be consumed in order to allow/enhance `Raw Results`.

Concrete example :
- `Phenotyping Test`
- `Genotyping Test`

#### Phenotyping Test
Analyse cells in order to see DNA expression's result.
This implies using a FACS machine which is also consuming `Consumables`.

#### Genotyping Test
Analyse DNA.
This implies using a PCR machine and a Electrophoresis machine which is also consuming `Consumables`.

#### Test Tube
Test tube holding DNA extracts to be tested during `Biologic Test`.

#### Consumable
Material necessary to complete a `Biologic Test`. These materials are consumed during the process.
Regularly the `Testing Machine` needs to be replenished by more `Consumable`.

Concrete example :
- Platinum Blue SuperMix
- FACS Buffer
- Diluted Primer
- Agarose

### Events

#### Consumed
Occurs whenever a `Testing Machine` performs a `Biologic Test`.


## Supplier

--------------------------

Supplier delivers `Consumable` to laboratory whenever `Biologic Sample Testing ERP` request it via its REST API

Concrete example :
- Invitrogen

### Objects

#### Delivery
Managed by a third party and provide `Consumable` to the laboratory.
They takes times - about 2 weeks. Hence must be anticipated.

#### Delivery threshold
`Consumable` quantity threshold implying to ask a `Supplier` for a new `Consumable` `Delivery` to be sent.

### Events

#### Delivery Sent
Event implied a `Delivery` has been sent

#### Delivery Receive
Event implying a `Delivery` has been received
