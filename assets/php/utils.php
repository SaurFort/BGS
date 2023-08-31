<?php
    function random($min, $max) {
        return rand($min, $max);
    }

    function createPerm($rank) {
        $sellPerm = "no";
        $prodPerm = "no";
        $rawMaterial = "no";
        $accountPerm = "no";
        $adminPerm = "no";

        if($rank == "commis") {
            $sellPerm = "yes";
            $prodPerm = "yes";
            $rawMaterial = "no";
            $accountPerm = "no";
            $adminPerm = "no";
        } else if($rank == "cuisinier") {
            $sellPerm = "yes";
            $prodPerm = "yes";
            $rawMaterial = "yes";
            $accountPerm = "no";
            $adminPerm = "no";
        } else if($rank == "chef-equipe") {
            $sellPerm = "yes";
            $prodPerm = "yes";
            $rawMaterial = "yes";
            $accountPerm = "no";
            $adminPerm = "no";
        } else if($rank == "manager") {
            $sellPerm = "yes";
            $prodPerm = "yes";
            $rawMaterial = "yes";
            $accountPerm = "yes";
            $adminPerm = "no";
        } else if($rank == "co-patron") {
            $sellPerm = "yes";
            $prodPerm = "yes";
            $rawMaterial = "yes";
            $accountPerm = "yes";
            $adminPerm = "yes";
        } else if($rank == "patron") {
            $sellPerm = "yes";
            $prodPerm = "yes";
            $rawMaterial = "yes";
            $accountPerm = "yes";
            $adminPerm = "yes";
        }

        $_SESSION['sell-perm'] = $sellPerm;
        $_SESSION['prod-perm'] = $prodPerm;
        $_SESSION['raw-material'] = $rawMaterial;
        $_SESSION['account-perm'] = $accountPerm;
        $_SESSION['admin-perm'] = $adminPerm;
    }
?>