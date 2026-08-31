<?php

namespace App\Services;

use LDAP\Result;

class CalculateurPrix
{
    /**
     * Calcule le prix TTC à partir d'un prix HT et d'un taux de taxe.
     * Le taux de taxe est exprimé en décimal (ex: 0.15 pour 15%).
     *
     * @throws \InvalidArgumentException si le taux est négatif
     */
    public function calculerAvecTaxe(float $prixHT, float $tauxTaxe): float
    {
        $resultat = null;
        if ($tauxTaxe < 0 or $prixHT < 0) {
            $resultat = round($prixHT*($tauxTaxe),2);
        }
        return $resultat;
    }

    /**
     * Applique une remise en pourcentage sur un prix.
     * La remise ne peut pas rendre le prix négatif.
     *
     * @throws \InvalidArgumentException si la remise est négative
     */
    public function appliquerRemise(float $prix, float $remisePourcentage): float
    {
        if ($remisePourcentage < 0) {
            throw new \InvalidArgumentException('La remise ne peut pas être négative.');
        }
        if ($prix < 0) {
            throw new \InvalidArgumentException('Le prix ne peut pas être négatif.');
        }

        $prixApresRemise = $prix - ($prix * $remisePourcentage / 100);

        return max(0, round($prixApresRemise, 2));
    }

    /**
     * Vérifie si un prix respecte un seuil minimum.
     *
     * @throws \InvalidArgumentException si le seuil est négatif
     */
    public function respecteSeuilMinimum(float $prix, float $seuilMinimum): bool
    {
        if ($seuilMinimum < 0) {
            throw new \InvalidArgumentException('Le seuil minimum ne peut pas être négatif.');
        }
        if ($prix < 0) {
            throw new \InvalidArgumentException('Le prix ne peut pas être négatif.');
        }

        return $prix >= $seuilMinimum;
    }
}
