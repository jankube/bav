<?php




/**
 * Implements 90c
 *
 * Copyright (C) 2006  Markus Malkusch <markus@malkusch.de>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */


class BAV_Validator_90c extends BAV_Validator_Iteration_Weighted {


    public function __construct(BAV_Bank $bank) {
        parent::__construct($bank);

        $this->setWeights(array(2, 3, 4, 5, 6));
        $this->setEnd(4);
    }


    protected function iterationStep() {
        $this->accumulator += $this->number * $this->getWeight();
    }


    protected function getResult() {
        $result = 7 - $this->accumulator % 7;
        $result = $result == 7
                ? 0
                : $result % 10;
        return $this->account{9} < 7 && (string)$result === $this->getCheckNumber();
    }


}

?>