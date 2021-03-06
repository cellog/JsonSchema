<?php
/**
 * json-schema-draft-01 Environment
 * 
 * @fileOverview Implementation of the first revision of the JSON Schema specification draft.
 * @author Gary Court <gary.court@gmail.com>
 * @author Gregory Beaver <greg@chiaraquartet.net>
 * @version 1.5
 * @see http://github.com/garycourt/JSV
 */
namespace Pyrus\JsonSchema\JSV\Schema\Draft03;

/*
 * Copyright 2010 Gary Court. All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 * 
 *    1. Redistributions of source code must retain the above copyright notice, this list of
 *       conditions and the following disclaimer.
 * 
 *    2. Redistributions in binary form must reproduce the above copyright notice, this list
 *       of conditions and the following disclaimer in the documentation and/or other materials
 *       provided with the distribution.
 * 
 * THIS SOFTWARE IS PROVIDED BY GARY COURT ``AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL GARY COURT OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * The views and conclusions contained in the software and documentation are those of the
 * authors and should not be interpreted as representing official policies, either expressed
 * or implied, of Gary Court or the JSON Schema specification.
 */

use Pyrus\JsonSchema\JSV\Exception, Pyrus\JsonSchema\JSV\ValidationException, Pyrus\JsonSchema\JSV\JSONInstance, Pyrus\JsonSchema\JSV\JSONSchema,
    Pyrus\JsonSchema\JSV\Report, Pyrus\JsonSchema\JSV\URI, Pyrus\JsonSchema\JSV\EnvironmentOptions, Pyrus\JsonSchema\JSV\Environment,
    Pyrus\JsonSchema\JSV, Pyrus\JsonSchema as JS, Pyrus\JsonSchema\JSV\Schema;

class Draft02 extends Schema\Draft02
{
    function initializeSchema($uri = "http://json-schema.org/draft-02/schema#")
    {
        return parent::initializeSchema($uri);
    }

    function initializeHyperSchema($uri1 = "http://json-schema.org/draft-02/hyper-schema#", $uri2 = "http://json-schema.org/draft-02/hyper-schema#")
    {
        return parent::initializeHyperSchema($uri1, $uri2);
    }

    function initializeLinks($uri = "http://json-schema.org/draft-02/links#")
    {
        return parent::initializeLinks($uri);
    }

    function registerSchemas()
    {
        //We need to reinitialize these 3 schemas as they all reference each other
        $this->SCHEMA = $this->ENVIRONMENT->createSchema($this->SCHEMA->getValue(), $this->HYPERSCHEMA, "http://json-schema.org/draft-02/schema#");
        $this->HYPERSCHEMA = $this->ENVIRONMENT->createSchema($this->HYPERSCHEMA->getValue(), $this->HYPERSCHEMA, "http://json-schema.org/draft-02/hyper-schema#");
        $this->LINKS = $this->ENVIRONMENT->createSchema($this->LINKS->getValue(), $this->HYPERSCHEMA, "http://json-schema.org/draft-02/links#");
    }


    function getSchemaArray()
    {
        $schema = parent::getSchemaArray();
        $schema['$schema'] = "http://json-schema.org/draft-02/hyper-schema#";
        $schema['id'] = "http://json-schema.org/draft-02/schema#";
        $this->insert($schema, 'properties/divisibleBy', 'maxDecimal', array(
				'deprecated' => true
			));
        return $schema;
    }

    function getHyperSchemaArray()
    {
        $schema = parent::getHyperSchemaArray();
        $schema['$schema'] = "http://json-schema.org/draft-02/hyper-schema#";
        $schema['id'] = "http://json-schema.org/draft-02/hyper-schema#";
        return $schema;
    }

    function getLinksArray()
    {
        $schema = parent::getLinksArray();
        $schema['$schema'] = "http://json-schema.org/draft-02/hyper-schema#";
        $schema['id'] = "http://json-schema.org/draft-02/links#";
        return $schema;
    }
}