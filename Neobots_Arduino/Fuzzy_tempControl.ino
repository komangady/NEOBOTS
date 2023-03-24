void fuzzy_tempControl()
{
    // Instantiating a FuzzyInput object * input error
  FuzzyInput *error = new FuzzyInput(1);
  FuzzySet *VL_I = new FuzzySet(-10, -10, -8, -4);
  error->addFuzzySet(VL_I);
  FuzzySet *L_I = new FuzzySet(-8, -4, 0, 0);
  error->addFuzzySet(L_I);
  FuzzySet *M_I = new FuzzySet(-4, 0, 4, 4);
  error->addFuzzySet(M_I);
  FuzzySet *H_I = new FuzzySet(0, 4, 8, 8);
  error->addFuzzySet(H_I);
  FuzzySet *VH_I = new FuzzySet(4, 8, 10, 10);
  error->addFuzzySet(VH_I);
  fuzzy->addFuzzyInput(error);

    // Instantiating a FuzzyInput object * input error speed
  FuzzyInput *error_speed = new FuzzyInput(2);
  FuzzySet *L_IS = new FuzzySet(-10, -10, -5, -1);
  error_speed->addFuzzySet(L_IS);
  FuzzySet *H_IS = new FuzzySet(1, 5, 10, 10);
  error_speed->addFuzzySet(H_IS);
  fuzzy->addFuzzyInput(error_speed);
  

  // Instantiating a FuzzyOutput objects
  FuzzyOutput *speed = new FuzzyOutput(1);
  FuzzySet *VL_O = new FuzzySet(0, 0, 0, 30);
  speed->addFuzzySet(VL_O);
  FuzzySet *L_O = new FuzzySet(0, 30, 50, 50);
  speed->addFuzzySet(L_O);
  FuzzySet *M_O = new FuzzySet(30, 50, 70, 70);
  speed->addFuzzySet(M_O);
  FuzzySet *H_O = new FuzzySet(50, 70, 100, 100);
  speed->addFuzzySet(H_O);
   FuzzySet *VH_O = new FuzzySet(70, 100, 100, 100);
  speed->addFuzzySet(H_O);
  fuzzy->addFuzzyOutput(speed);


  FuzzyRuleAntecedent *ifVLandL = new FuzzyRuleAntecedent();
  ifVLandL->joinWithAND(VL_I, L_IS);
  FuzzyRuleConsequent *thenVL = new FuzzyRuleConsequent();
  thenVL->addOutput(VL_O);
  FuzzyRule *fuzzyRule01 = new FuzzyRule(1, ifVLandL, thenVL);
  fuzzy->addFuzzyRule(fuzzyRule01);

  FuzzyRuleAntecedent *ifLandL = new FuzzyRuleAntecedent();
  ifLandL->joinWithAND(L_I, L_IS);
  FuzzyRuleConsequent *thenL = new FuzzyRuleConsequent();
  thenL->addOutput(L_O);
  FuzzyRule *fuzzyRule02 = new FuzzyRule(2, ifLandL, thenL);
  fuzzy->addFuzzyRule(fuzzyRule02);

  FuzzyRuleAntecedent *ifM = new FuzzyRuleAntecedent();
  ifM->joinSingle(M_I);
  FuzzyRuleConsequent *thenM = new FuzzyRuleConsequent();
  thenM->addOutput(M_O);
  FuzzyRule *fuzzyRule03 = new FuzzyRule(3, ifM, thenM);
  fuzzy->addFuzzyRule(fuzzyRule03);

  FuzzyRuleAntecedent *ifHandH = new FuzzyRuleAntecedent();
  ifHandH->joinWithAND(H_I, H_IS);
  FuzzyRuleConsequent *thenH = new FuzzyRuleConsequent();
  thenH->addOutput(H_O);
  FuzzyRule *fuzzyRule04 = new FuzzyRule(4, ifHandH, thenH);
  fuzzy->addFuzzyRule(fuzzyRule04);

  FuzzyRuleAntecedent *ifVHandH = new FuzzyRuleAntecedent();
  ifVHandH->joinWithAND(VH_I, H_IS);
  FuzzyRuleConsequent *thenVH = new FuzzyRuleConsequent();
  thenVH->addOutput(VH_O);
  FuzzyRule *fuzzyRule05 = new FuzzyRule(5, ifVHandH, thenVH);
  fuzzy->addFuzzyRule(fuzzyRule05);

  
}
